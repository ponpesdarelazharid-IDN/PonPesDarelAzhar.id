$ErrorActionPreference = "Continue"

function Set-VercelEnv {
    param($name, $value, $env = "production")
    Write-Host "Setting $name..."
    $value | vercel env add $name $env --force 2>&1
}

# APP Settings
Set-VercelEnv "APP_NAME" "Pondok Pesantren Modern Darul Azhar"
Set-VercelEnv "APP_ENV" "production"
Set-VercelEnv "APP_KEY" "base64:CzGWbZVvT8eW8o3/wurk/jBpsjgU9d9jhxuPUZKwW1Y="
Set-VercelEnv "APP_DEBUG" "true"
Set-VercelEnv "APP_URL" "https://pon-pes-darel-azhar-id.vercel.app"
Set-VercelEnv "ASSET_URL" "https://pon-pes-darel-azhar-id.vercel.app"
Set-VercelEnv "APP_LOCALE" "id"
Set-VercelEnv "APP_FALLBACK_LOCALE" "id"

# Logging
Set-VercelEnv "LOG_CHANNEL" "stderr"
Set-VercelEnv "LOG_LEVEL" "debug"

# Database - TiDB
Set-VercelEnv "DB_CONNECTION" "mysql"
Set-VercelEnv "DB_HOST" "gateway01.ap-southeast-1.prod.aws.tidbcloud.com"
Set-VercelEnv "DB_PORT" "4000"
Set-VercelEnv "DB_DATABASE" "github_sample"
Set-VercelEnv "DB_USERNAME" "4Gqc5bZT2yECk8v.root"
Set-VercelEnv "DB_PASSWORD" "npfVlnKfhL5e7eOG"
Set-VercelEnv "MYSQL_ATTR_SSL_CA" "/var/task/cacert.pem"

# Session & Cache
Set-VercelEnv "SESSION_DRIVER" "cookie"
Set-VercelEnv "SESSION_LIFETIME" "120"
Set-VercelEnv "SESSION_ENCRYPT" "false"
Set-VercelEnv "SESSION_PATH" "/"
Set-VercelEnv "CACHE_STORE" "array"
Set-VercelEnv "QUEUE_CONNECTION" "sync"
Set-VercelEnv "BROADCAST_CONNECTION" "log"

# Filesystem
Set-VercelEnv "FILESYSTEM_DISK" "cloudinary"

# Mail
Set-VercelEnv "MAIL_MAILER" "smtp"
Set-VercelEnv "MAIL_HOST" "smtp.gmail.com"
Set-VercelEnv "MAIL_PORT" "465"
Set-VercelEnv "MAIL_USERNAME" "ponpesdarelazhar.id@gmail.com"
Set-VercelEnv "MAIL_PASSWORD" "1980578344094040"
Set-VercelEnv "MAIL_ENCRYPTION" "ssl"
Set-VercelEnv "MAIL_FROM_ADDRESS" "ponpesdarelazhar.id@gmail.com"
Set-VercelEnv "MAIL_FROM_NAME" "Pondok Pesantren Modern Darul Azhar"

# Cloudinary
Set-VercelEnv "CLOUDINARY_CLOUD_NAME" "dmq8it5i2"
Set-VercelEnv "CLOUDINARY_API_KEY" "954653981238793"
Set-VercelEnv "CLOUDINARY_API_SECRET" "td3UX8sBle-ti4WEYVD17WkzhrQ"

Write-Host ""
Write-Host "=== ALL ENV VARS SET SUCCESSFULLY ===" -ForegroundColor Green
