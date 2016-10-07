#Syncs the local code base to the server and then restarts it
rsync -a $(pwd)/*.* root@192.241.139.204:/var/www/html/
ssh root@192.241.139.204 'sudo service apache2 restart'
echo "ALL IS WELL!!"