# RaveFramework

##Description
Simple but safe PHP MVC Framework. We try to keep it as simple as possible.

##License
This Framework is under GNU/GPL license.

## Configuration

### Apache :

Uncomment the commented lines. Make sure that mod_rewrite is installed on your system.

### Nginx :

make sure that it contains these lines :
```nginx
    location / { # enabling redirection
        try_files $uri $uri/ =404;
        rewrite ^(.*) /index.php?url=$1;
    }
```

bonus:
to optimize static files
```nginx
    location ~* \.(jpg|jpeg|gif|png|ico|bmp|css|js|zip|tgz|gz|rar|bz2|doc|xls|exe|dmg|pdf|ppt|txt|tar|rtf)$ {
        access_log off;
        expires max;
        root   /your/path/to/public_html/;
    }

    location ~ /\.ht {
        deny all;
    }
```