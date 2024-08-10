$filepath = "C:\Users\Administrator\Dev\GLEARNING-RP-NEW\1.fontes-a-converter.md"

$lines = Get-Content -Path $filepath 


foreach ($line in $lines) {
    if (-not [string]::IsNullOrWhiteSpace($line)) {

        $cleanLine = $line.Replace(".cs", "")
        
        $phpFilePath = "C:\Users\Administrator\Dev\GL-BACKEND\" + $cleanLine + ".php"

        New-Item -ItemType File -Path $phpFilePath -Force
    }
}

Write-Host "Arquivos criados com sucesso!"
Start-Sleep -s 15