import os
import subprocess
import time

env_vars = {
    "APP_NAME": "Pondok Pesantren Modern Darul Azhar",
    "APP_ENV": "production",
    "APP_KEY": "base64:CzGWbZVvT8eW8o3/wurk/jBpsjgU9d9jhxuPUZKwW1Y=",
    "APP_DEBUG": "false",
    "APP_URL": "https://pon-pes-darel-azhar-id.vercel.app",
    "ASSET_URL": "https://pon-pes-darel-azhar-id.vercel.app",
    "APP_LOCALE": "id",
    "APP_FALLBACK_LOCALE": "id",
    "LOG_CHANNEL": "stderr",
    "LOG_LEVEL": "debug",
    "DB_CONNECTION": "mysql",
    "DB_HOST": "gateway01.ap-southeast-1.prod.aws.tidbcloud.com",
    "DB_PORT": "4000",
    "DB_DATABASE": "github_sample",
    "DB_USERNAME": "4Gqc5bZT2yECk8v.root",
    "DB_PASSWORD": "npfVlnKfhL5e7eOG",
    "MYSQL_ATTR_SSL_CA": "/var/task/cacert.pem",
    "SESSION_DRIVER": "cookie",
    "SESSION_LIFETIME": "120",
    "SESSION_ENCRYPT": "false",
    "SESSION_PATH": "/",
    "CACHE_STORE": "array",
    "QUEUE_CONNECTION": "sync",
    "BROADCAST_CONNECTION": "log",
    "FILESYSTEM_DISK": "cloudinary",
    "MAIL_MAILER": "smtp",
    "MAIL_HOST": "smtp.gmail.com",
    "MAIL_PORT": "465",
    "MAIL_USERNAME": "ponpesdarelazhar.id@gmail.com",
    "MAIL_PASSWORD": "1980578344094040",
    "MAIL_ENCRYPTION": "ssl",
    "MAIL_FROM_ADDRESS": "ponpesdarelazhar.id@gmail.com",
    "MAIL_FROM_NAME": "Pondok Pesantren Modern Darul Azhar",
    "CLOUDINARY_CLOUD_NAME": "dmq8it5i2",
    "CLOUDINARY_API_KEY": "954653981238793",
    "CLOUDINARY_API_SECRET": "td3UX8sBle-ti4WEYVD17WkzhrQ"
}

print("Setting Vercel Environments via Python...")
for k, v in env_vars.items():
    print(f"Setting {k}...")
    try:
        p = subprocess.Popen(["vercel", "env", "rm", k, "production", "--yes"], stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
        p.communicate() # delete old if any to avoid issues, we don't care if it errors
    except:
        pass
        
    p2 = subprocess.Popen(["vercel", "env", "add", k, "production", "--force"], stdin=subprocess.PIPE, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True)
    out, err = p2.communicate(input=v.encode('utf-8'))
    if b'Overrode' in err or b'Added' in err or b'Overrode' in out or b'Added' in out:
        print(f"SUCCESS {k}")
    else:
        print(f"FAILED {k}: {err.decode('utf-8')}")
