#Ansible Installation for Behat-GUI

# Main.yml
This is the notation for the main.yml that we use to deploy
```---
- name: setup behat-env
  sudo: true
  hosts: webservers

  vars:
    mysql_port: 3306                 # The port for mysql server to listen
    mysql_bind_address: "0.0.0.0"    # The bind address for mysql server
    mysql_root_db_pass: 123       # The root DB password

    # A list that has all the databases to be
    # created and their replication status:
    mysql_db:
    - name: behat
      replicate: yes

    # A list of the mysql users to be created
    # and their password and privileges:
    mysql_users:
    - name: benz
      pass: foobar
      priv: "*.*:ALL"

    # If the database is replicated the users
    # to be used for replication:
    mysql_repl_user:
    - name: behat
      pass: 123

    # The role of this server in replication:
    mysql_repl_role: master

    # A unique id for the mysql server (used in replication):
    mysql_db_id: 7

    firewall_allowed_tcp_ports:
    - "22"
    - "80"

  roles:
     - { role: ansible_uclalib_role_apache }
     - { role: bennojoy.mysql }
     - { role: ansible_uclalib_role_php }
     - { role: ansible_uclalib_role_chrome }
     - { role: geerlingguy.java}
     - { role: ansible_uclalib_role_headless_selenium }
     - { role: arknoll.selenium }
     - { role: tersmitten.composer }
     - { role: davidkarban.git }
     - { role: geerlingguy.firewall }
     - { role: ansible_uclalib_role_behat }```
