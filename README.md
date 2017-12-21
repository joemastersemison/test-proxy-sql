# test-proxy-sql
Example code and instructions to test proxysql.com

# database
For this, I'm using the MySQL sample database available here: https://github.com/datacharmer/test_db

# credentials.inc
You must make a file with credentials called credentials.inc in the php directory as follows:
```
<?php
  $servername = "";
  $username = "";
  $password = "";
  $dbname = "employees";
?>
```

# Installing and configuring proxysql
1. Download proxysql: https://github.com/sysown/proxysql/releases/latest
2. Install: for Ubuntu, I ran: `sudo dpkg -i proxysql_1.4.4-dbg-ubuntu16_amd64.deb`
3. Start: `sudo service proxysql start`
4. Configure: `mysql -u admin -padmin -h 127.0.0.1 -P6032 --prompt='Admin> '`
```
INSERT INTO mysql_servers (hostgroup_id,hostname,port) VALUES (1,'[master]',3306);
INSERT INTO mysql_servers (hostgroup_id,hostname,port) VALUES (2,'[read replica]',3306);
LOAD MYSQL SERVERS TO RUNTIME; 
SAVE MYSQL SERVERS TO DISK;

INSERT INTO mysql_users(username,password,default_hostgroup) VALUES ('[username that you have in credentials.inc]','[password you have in credentials.inc]',1);
LOAD MYSQL USERS TO RUNTIME;
SAVE MYSQL USERS TO DISK;

INSERT INTO mysql_query_rules (rule_id,active,username,match_digest,destination_hostgroup,apply) VALUES (10,1,'[username that you have in credentials.inc]','gender',2,1);
LOAD MYSQL QUERY RULES TO RUNTIME;
SAVE MYSQL QUERY RULES TO DISK;
```
5. Note that you can follow this tutorial for many more features in proxysql: https://github.com/sysown/proxysql/wiki/ProxySQL-Configuration

