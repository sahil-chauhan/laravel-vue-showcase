# Steps to Install

#1 create .env from .env.example just copy paste and fill in your DB and other credentials.

#1 Composer Install

#2 php artisan key:generate

#3 php artisan migrate --seed

# php artisan storage:link  -- Generate Stroage Link for Uploads

# FILESYSTEM_DRIVER=public


# Vue Install fro front End.

# npm install
# npm run dev

# Dummy User Accounts ::

#Super Admin : superadmin@gmail.com 

#Password : password

#Admin : admin@gmail.com 

#Password : password

#User : user@gmail.com 

#Password : password

# For Sanctum Api Auth 

# SESSION_DRIVER=cookie

# SANCTUM_STATEFUL_DOMAINS=www.infused-addons-dev.com
# SESSION_DOMAIN=.infused-addons-dev.com

# For Pagination

# PAGINATE_RESULTS_COUNT=7