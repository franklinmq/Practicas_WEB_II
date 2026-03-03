$path = "c:\xampp\htdocs\Tercero\1er Bim"
$filter = "*.*" # Puedes cambiarlo a "*.php", "*.html", "*.css", "*.js" si prefieres

$watcher = New-Object System.IO.FileSystemWatcher
$watcher.Path = $path
$filter = "*.*"
$watcher.IncludeSubdirectories = $true
$watcher.EnableRaisingEvents = $true

Write-Host "🚀 Auto-Sync Git activado en: $path"
Write-Host "Presiona Ctrl+C para detener."

$action = {
    $path = $Event.SourceEventArgs.FullPath
    $name = $Event.SourceEventArgs.Name
    $changeType = $Event.SourceEventArgs.ChangeType
    
    # Ignorar la carpeta .git para evitar bucles infinitos
    if ($path -notmatch "\\.git\\") {
        Write-Host "📝 Cambio detectado ($changeType): $name"
        cd "c:\xampp\htdocs\Tercero\1er Bim"
        
        # Esperar un momento para asegurar que el archivo se guardó completamente
        Start-Sleep -Seconds 1
        
        git add .
        git commit -m "Auto-sync: $name modificado"
        git push origin main
        
        Write-Host "✅ Sincronizado con GitHub!"
        Write-Host "----------------------------"
    }
}

Register-ObjectEvent $watcher "Changed" -Action $action
Register-ObjectEvent $watcher "Created" -Action $action
Register-ObjectEvent $watcher "Deleted" -Action $action
Register-ObjectEvent $watcher "Renamed" -Action $action

while ($true) { Start-Sleep -Seconds 1 }
