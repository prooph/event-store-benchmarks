 #!/bin/bash -ex

mongo <<EOF
  rs.status();
EOF
