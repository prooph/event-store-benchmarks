 #!/bin/bash -ex

mongo <<EOF
  rs.initiate({'_id':'cluster',members:[{'_id':0,'host':'node0.mongodb.local:27017'},{'_id':1,'host':'node1.mongodb.local:27017'},{'_id':2,'host':'node2.mongodb.local:27017'}]});
EOF
