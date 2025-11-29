#!/bin/bash

MYSQL_ROOT_PASS="Nm3ZaMg64"  # ← Remplace ici
DB_NAME="nsapool"
DB_USER="username"
DB_PASS="password"
SQL_FILE="/home/server/devops/student_day05/nsapool.sql"  # ← Vérifie le chemin

echo "Configuration de la base de données..."

# Exécuter les commandes MySQL
mysql -u root -p"$MYSQL_ROOT_PASS" <<EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASS';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

echo "Import des données..."
mysql -u root -p"$MYSQL_ROOT_PASS" $DB_NAME < $SQL_FILE

echo "Vérification..."
mysql -u root -p"$MYSQL_ROOT_PASS" $DB_NAME -e "SELECT * FROM user;"

echo "✓ Configuration terminée!"