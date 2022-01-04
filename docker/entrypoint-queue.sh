queueLockFile=docker/.queue-ready.lock

while [ ! -f "$queueLockFile" ]
    do 
        sleep 5
        echo "Waiting .queue-ready.lock ..."
done

# unlock
rm docker/.queue-ready.lock
echo "Queue starting..."

TST=$@
exec bash -c "$TST"
