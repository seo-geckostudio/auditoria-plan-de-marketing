@echo off
echo ========================================
echo  Servidor PHP - Accesible desde Red Local
echo ========================================
echo.
echo IP Local: 192.168.1.100:8095
echo Puerto: 8095
echo.
echo El servidor sera accesible desde:
echo   - http://localhost:8095
echo   - http://192.168.1.100:8095
echo   - http://[IP de otro dispositivo en red]:8095
echo.
echo Presiona Ctrl+C para detener el servidor
echo ========================================
echo.

cd /d "%~dp0ibiza villa\FASE_5_ENTREGABLES_FINALES\WEB_AUDITORIA"
"%~dp0php\php.exe" -S 0.0.0.0:8095

pause
