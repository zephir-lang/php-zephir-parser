#!/usr/bin/env bash
#
# This file is part of the Zephir.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

shopt -s nullglob

export LC_ALL=C

while IFS= read -r -d '' file
do
  (( count++ ))
  (>&1 printf ">>> START (%d)\\n%s\\n<<< END (%d)\\n\\n" $count "$(cat "$file")" $count)
done < <(find ./tests -type f \( -name '*.out' -o -name '*.mem' \) -print0)

for i in /tmp/core.php.*; do
  (>&1 printf "Found core dump file: %s\\n\\n" "$i")
  gdb -q "$(phpenv which php)" "$i" <<EOF
set pagination 0
backtrace full
info registers
x/16i \$pc
thread apply all backtrace
quit
EOF
done
