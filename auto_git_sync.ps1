$path = 'c:\xampp\htdocs\Tercero\1er Bim'

$watcher = New-Object System.IO.FileSystemWatcher
$watcher.Path = $path
$watcher.IncludeSubdirectories = $true
$watcher.EnableRaisingEvents = $true

Write-Host "🚀 Auto-Sync Git activado en: $path"
Write-Host "Presiona Ctrl+C para detener."

$action = {
    $itemPath = $Event.SourceEventArgs.FullPath
    $itemName = $Event.SourceEventArgs.Name
    $type = $Event.SourceEventArgs.ChangeType
    
    # Ignorar la carpeta .git y el propio script
    if ($itemPath -notmatch '\\.git\\' -and $itemName -ne 'auto_git_sync.ps1') {
        Write-Host "📝 Cambio detectado: $itemName ($type)"
        Set-Location 'c:\xampp\htdocs\Tercero\1er Bim'
        
        # Pequeña espera para asegurar que el archivo se guardó completamente
        Start-Sleep -Seconds 1
        
        git add .
        git commit -m "Auto-sync: $itemName actualizado"
        git push origin main
        
        Write-Host "✅ Sincronizado con GitHub!"
        Write-Host "----------------------------"
    }
}

# Registrar eventos
$evtChanged = Register-ObjectEvent $watcher "Changed" -Action $action
$evtCreated = Register-ObjectEvent $watcher "Created" -Action $action
$evtDeleted = Register-ObjectEvent $watcher "Deleted" -Action $action
$evtRenamed = Register-ObjectEvent $watcher "Renamed" -Action $action

try {
    while ($true) { Start-Sleep -Seconds 1 }
}
finally {
    # Limpiar al salir
    Unregister-Event -SourceIdentifier $evtChanged.Name
    Unregister-Event -SourceIdentifier $evtCreated.Name
    Unregister-Event -SourceIdentifier $evtDeleted.Name
    Unregister-Event -SourceIdentifier $evtRenamed.Name
    $watcher.Dispose()
}
