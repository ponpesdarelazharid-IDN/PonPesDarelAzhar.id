@echo off
echo === Setting Vercel Environment Variables ===

echo Pondok Pesantren Modern Darul Azhar| vercel env add APP_NAME production --force
echo production| vercel env add APP_ENV production --force
echo base64:CzGWbZVvT8eW8o3/wurk/jBpsjgU9d9jhxuPUZKwW1Y=| vercel env add APP_KEY production --force
echo false| vercel env add APP_DEBUG production --force
echo https://pon-pes-darel-azhar-id.vercel.app| vercel env add APP_URL production --force
echo https://pon-pes-darel-azhar-id.vercel.app| vercel env add ASSET_URL production --force
echo id| vercel env add APP_LOCALE production --force
echo id| vercel env add APP_FALLBACK_LOCALE production --force
echo stderr| vercel env add LOG_CHANNEL production --force
echo error| vercel env add LOG_LEVEL production --force

echo === DB Settings ===
echo mysql| vercel env add DB_CONNECTION production --force
echo gateway01.ap-southeast-1.prod.aws.tidbcloud.com| vercel env add DB_HOST production --force
echo 4000| vercel env add DB_PORT production --force
echo github_sample| vercel env add DB_DATABASE production --force
echo 4Gqc5bZT2yECk8v.root| vercel env add DB_USERNAME production --force
echo npfVlnKfhL5e7eOG| vercel env add DB_PASSWORD production --force
echo /var/task/cacert.pem| vercel env add MYSQL_ATTR_SSL_CA production --force

echo === Session & Cache ===
echo cookie| vercel env add SESSION_DRIVER production --force
echo 120| vercel env add SESSION_LIFETIME production --force
echo false| vercel env add SESSION_ENCRYPT production --force
echo /| vercel env add SESSION_PATH production --force
echo array| vercel env add CACHE_STORE production --force
echo sync| vercel env add QUEUE_CONNECTION production --force
echo log| vercel env add BROADCAST_CONNECTION production --force

echo === Filesystem ===
echo cloudinary| vercel env add FILESYSTEM_DISK production --force

echo === Mail Settings ===
echo smtp| vercel env add MAIL_MAILER production --force
echo smtp.gmail.com| vercel env add MAIL_HOST production --force
echo 465| vercel env add MAIL_PORT production --force
echo ponpesdarelazhar.id@gmail.com| vercel env add MAIL_USERNAME production --force
echo 1980578344094040| vercel env add MAIL_PASSWORD production --force
echo ssl| vercel env add MAIL_ENCRYPTION production --force
echo ponpesdarelazhar.id@gmail.com| vercel env add MAIL_FROM_ADDRESS production --force
echo Pondok Pesantren Modern Darul Azhar| vercel env add MAIL_FROM_NAME production --force

echo === Cloudinary Settings ===
echo dmq8it5i2| vercel env add CLOUDINARY_CLOUD_NAME production --force
echo 954653981238793| vercel env add CLOUDINARY_API_KEY production --force
echo td3UX8sBle-ti4WEYVD17WkzhrQ| vercel env add CLOUDINARY_API_SECRET production --force

echo === Done! All env vars set ===
