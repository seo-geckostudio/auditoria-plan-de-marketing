#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script para automatizar exportación de Screaming Frog en servidor remoto
Compatible con acceso por red (SSH, RDP, carpetas compartidas)
Autor: AI Assistant
Fecha: 2025
"""

import os
import time
import subprocess
import paramiko
from pathlib import Path
import json
from datetime import datetime
import shutil
import requests

class ScreamingFrogRemoteExporter:
    def __init__(self, config_file="remote_config.json"):
        self.config_file = config_file
        self.config = self.load_config()
        # Destino local: usar carpeta del sitio si está configurada
        self.local_export_dir = Path(
            self.config.get("screaming_frog", {}).get(
                "local_destination", "datos_screaming_frog/exports_csv"
            )
        )
        self.local_export_dir.mkdir(parents=True, exist_ok=True)
        
    def load_config(self):
        """Cargar configuración de conexión remota"""
        default_config = {
            "connection_type": "shared_folder",  # shared_folder, ssh, rdp
            "remote_server": {
                "ip": "192.168.1.100",
                "username": "usuario",
                "password": "contraseña",
                "port": 22
            },
            "screaming_frog": {
                "remote_export_path": "\\\\192.168.1.100\\ScreamingFrog\\exports",
                "local_mount": "",
                "local_destination": "datos_previos_a_la_auditoria/exports_csv",
                "remote_executable": "C:\\Program Files (x86)\\Screaming Frog SEO Spider\\ScreamingFrogSEOSpider.exe"
            },
            "export_files": [
                "SF_internal_all.csv",
                "SF_response_codes.csv",
                "SF_page_titles_all.csv",
                "SF_page_titles_missing.csv",
                "SF_page_titles_duplicate.csv",
                "SF_meta_descriptions_all.csv",
                "SF_meta_descriptions_missing.csv",
                "SF_h1_all.csv",
                "SF_h1_missing.csv",
                "SF_h2_all.csv",
                "SF_content_duplicates.csv",
                "SF_word_count.csv",
                "SF_images_missing_alt.csv",
                "SF_images_large.csv",
                "SF_internal_links.csv",
                "SF_orphan_pages.csv"
            ]
        }
        
        if os.path.exists(self.config_file):
            with open(self.config_file, 'r', encoding='utf-8') as f:
                return json.load(f)
        else:
            # Crear archivo de configuración por defecto
            with open(self.config_file, 'w', encoding='utf-8') as f:
                json.dump(default_config, f, indent=2, ensure_ascii=False)
            print(f"📝 Archivo de configuración creado: {self.config_file}")
            print("⚠️ Por favor, edita la configuración antes de continuar")
            return default_config
    
    def test_connection(self):
        """Probar conexión al servidor remoto"""
        print("🔍 Probando conexión al servidor remoto...")
        
        connection_type = self.config["connection_type"]
        
        if connection_type == "shared_folder":
            return self.test_shared_folder()
        elif connection_type == "ssh":
            return self.test_ssh_connection()
        elif connection_type == "rdp":
            return self.test_rdp_connection()
        else:
            print("❌ Tipo de conexión no válido")
            return False
    
    def test_shared_folder(self):
        """Probar acceso a carpeta compartida"""
        try:
            remote_path = self.config["screaming_frog"]["remote_export_path"]
            
            # Intentar acceder a la carpeta compartida
            if os.path.exists(remote_path):
                print(f"✅ Carpeta compartida accesible: {remote_path}")
                return True
            else:
                print(f"❌ No se puede acceder a: {remote_path}")
                print("💡 Verifica que la carpeta esté compartida y tengas permisos")
                return False
                
        except Exception as e:
            print(f"❌ Error accediendo a carpeta compartida: {e}")
            return False
    
    def test_ssh_connection(self):
        """Probar conexión SSH"""
        try:
            server_config = self.config["remote_server"]
            
            ssh = paramiko.SSHClient()
            ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
            
            ssh.connect(
                hostname=server_config["ip"],
                username=server_config["username"],
                password=server_config["password"],
                port=server_config["port"],
                timeout=10
            )
            
            # Ejecutar comando de prueba
            stdin, stdout, stderr = ssh.exec_command("echo 'Conexión SSH exitosa'")
            result = stdout.read().decode().strip()
            
            ssh.close()
            
            if "exitosa" in result:
                print("✅ Conexión SSH establecida correctamente")
                return True
            else:
                print("❌ Error en conexión SSH")
                return False
                
        except Exception as e:
            print(f"❌ Error SSH: {e}")
            return False
    
    def export_via_shared_folder(self):
        """Exportar archivos vía carpeta compartida"""
        print("📁 Exportando vía carpeta compartida...")
        
        remote_path = Path(self.config["screaming_frog"]["remote_export_path"])
        files_copied = 0

        try:
            # Buscar recursivamente todos los CSV en la carpeta remota
            csv_files = list(remote_path.rglob("*.csv"))

            if not csv_files:
                print("⚠️ No se encontraron archivos CSV en la ruta remota")
            else:
                print(f"🔎 CSV encontrados: {len(csv_files)}")

            for remote_file in csv_files:
                try:
                    # Copiar a destino local manteniendo el nombre del archivo
                    local_file = self.local_export_dir / remote_file.name
                    shutil.copy2(remote_file, local_file)
                    print(f"✅ Copiado: {remote_file}")
                    files_copied += 1
                except Exception as e:
                    print(f"❌ Error copiando {remote_file}: {e}")

        except Exception as e:
            print(f"❌ Error recorriendo la carpeta remota: {e}")

        print(f"📊 Archivos copiados: {files_copied}/{len(csv_files) if 'csv_files' in locals() else 0}")
        return files_copied > 0
    
    def export_via_ssh(self):
        """Exportar archivos vía SSH/SCP"""
        print("🔐 Exportando vía SSH...")
        
        try:
            server_config = self.config["remote_server"]
            
            ssh = paramiko.SSHClient()
            ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
            
            ssh.connect(
                hostname=server_config["ip"],
                username=server_config["username"],
                password=server_config["password"],
                port=server_config["port"]
            )
            
            # Crear cliente SCP
            scp = ssh.open_sftp()
            files_copied = 0
            
            remote_base_path = "/home/usuario/screaming_frog_exports"  # Ajustar según tu configuración
            
            for filename in self.config["export_files"]:
                remote_file = f"{remote_base_path}/{filename}"
                local_file = self.local_export_dir / filename
                
                try:
                    scp.get(remote_file, str(local_file))
                    print(f"✅ Descargado: {filename}")
                    files_copied += 1
                except Exception as e:
                    print(f"⚠️ No se pudo descargar {filename}: {e}")
            
            scp.close()
            ssh.close()
            
            print(f"📊 Archivos descargados: {files_copied}/{len(self.config['export_files'])}")
            return files_copied > 0
            
        except Exception as e:
            print(f"❌ Error SSH: {e}")
            return False
    
    def trigger_remote_export(self):
        """Activar exportación en el servidor remoto"""
        print("🚀 Activando exportación remota...")
        
        connection_type = self.config["connection_type"]
        
        if connection_type == "ssh":
            return self.trigger_export_ssh()
        elif connection_type == "shared_folder":
            print("💡 Para carpeta compartida, ejecuta manualmente la exportación en el servidor")
            print("   O usa escritorio remoto para automatizar")
            return True
        else:
            print("⚠️ Activación automática no disponible para este tipo de conexión")
            return True
    
    def trigger_export_ssh(self):
        """Activar exportación vía SSH (si Screaming Frog soporta línea de comandos)"""
        try:
            server_config = self.config["remote_server"]
            
            ssh = paramiko.SSHClient()
            ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
            
            ssh.connect(
                hostname=server_config["ip"],
                username=server_config["username"],
                password=server_config["password"],
                port=server_config["port"]
            )
            
            # Comando para ejecutar Screaming Frog (ajustar según tu configuración)
            sf_path = self.config["screaming_frog"]["remote_executable"]
            export_command = f'"{sf_path}" --export-all --output-dir /home/usuario/screaming_frog_exports'
            
            print(f"🔧 Ejecutando: {export_command}")
            stdin, stdout, stderr = ssh.exec_command(export_command)
            
            # Esperar a que termine
            exit_status = stdout.channel.recv_exit_status()
            
            ssh.close()
            
            if exit_status == 0:
                print("✅ Exportación remota completada")
                return True
            else:
                print(f"❌ Error en exportación remota (código: {exit_status})")
                return False
                
        except Exception as e:
            print(f"❌ Error activando exportación SSH: {e}")
            return False
    
    def sync_files(self):
        """Sincronizar archivos desde servidor remoto"""
        print("🔄 Sincronizando archivos...")
        
        connection_type = self.config["connection_type"]
        
        if connection_type == "shared_folder":
            return self.export_via_shared_folder()
        elif connection_type == "ssh":
            return self.export_via_ssh()
        else:
            print("❌ Método de sincronización no implementado")
            return False
    
    def generate_sync_report(self):
        """Generar reporte de sincronización"""
        report = {
            "timestamp": datetime.now().isoformat(),
            "connection_type": self.config["connection_type"],
            "remote_server": self.config["remote_server"]["ip"],
            "local_files": [],
            "total_files": 0,
            "total_size_mb": 0
        }
        
        # Analizar archivos locales
        for csv_file in self.local_export_dir.glob("*.csv"):
            file_size = csv_file.stat().st_size
            file_info = {
                "filename": csv_file.name,
                "size_mb": round(file_size / (1024*1024), 2),
                "modified": datetime.fromtimestamp(csv_file.stat().st_mtime).isoformat()
            }
            report["local_files"].append(file_info)
            report["total_size_mb"] += file_info["size_mb"]
        
        report["total_files"] = len(report["local_files"])
        
        # Guardar reporte
        report_file = self.local_export_dir / "sync_report.json"
        with open(report_file, 'w', encoding='utf-8') as f:
            json.dump(report, f, indent=2, ensure_ascii=False)
        
        print(f"📋 Reporte de sincronización: {report_file}")
        return report

def main():
    """Función principal"""
    print("🕷️ SCREAMING FROG REMOTE EXPORTER")
    print("=" * 50)
    
    exporter = ScreamingFrogRemoteExporter()
    
    # Probar conexión
    if not exporter.test_connection():
        print("\n❌ No se pudo establecer conexión con el servidor remoto")
        print("💡 Verifica la configuración en remote_config.json")
        return
    
    # Activar exportación remota (si es posible)
    exporter.trigger_remote_export()
    
    # Sincronizar archivos
    if exporter.sync_files():
        # Generar reporte
        report = exporter.generate_sync_report()
        print(f"\n✅ SINCRONIZACIÓN COMPLETADA")
        print(f"📁 Archivos locales: {exporter.local_export_dir}")
        print(f"📊 Total archivos: {report['total_files']}")
        print(f"💾 Tamaño total: {report['total_size_mb']:.2f} MB")
    else:
        print("\n❌ Error en la sincronización")

if __name__ == "__main__":
    main()