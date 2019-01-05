#!/bin/sh

echo "CREATE DATABASE IF NOT EXISTS \`test_blog\` ;" | "${mysql[@]}"
echo "GRANT ALL ON \`test_blog\`.* TO '${MYSQL_USER}'@'%' ;" | "${mysql[@]}"
echo "FLUSH PRIVILEGES ;" | "${mysql[@]}"