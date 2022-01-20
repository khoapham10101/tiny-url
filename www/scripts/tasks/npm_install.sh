#!/bin/bash

. $(dirname ${BASH_SOURCE[0]})/../../.env
. $(dirname ${BASH_SOURCE[0]})/../../.env.local

echo -e "${LIGHT_GREEN}Generate assets(html/css/js).${NC}"

npm install
npm run dev
