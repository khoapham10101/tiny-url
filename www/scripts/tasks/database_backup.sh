#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Database backup.${NC}"

if [ -x "$(command -v git)" ]; then
    BRANCH_NOR_TAG_NAME="$(git symbolic-ref -q --short HEAD || git describe --tags --exact-match)"
    if [ -n "${BRANCH_NOR_TAG_NAME}" ]; then
        BACKUP_PATH="${BACKUP_PATH}/${BRANCH_NOR_TAG_NAME}"
    fi
fi
# Ensure the backups folder will exists.
mkdir -p ${BACKUP_PATH}
mysqldump -u ${DB_USERNAME} -p${DB_PASSWORD} -h ${DB_HOST} ${DB_DATABASE} > ${BACKUP_PATH}/${CURRENT_DATE}.sql
echo ${BACKUP_PATH}/${CURRENT_DATE}.sql
