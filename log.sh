#A Log tailer
echo "Ctrl + C to exit"
ssh root@192.241.139.204 'tail -f /var/log/apache2/error.log'
