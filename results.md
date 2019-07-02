
[32mTesting databases are (B[marangodb mariadb postgres mysql 
             Name                           Command              State            Ports         
------------------------------------------------------------------------------------------------
eventstorebenchmarks_arangodb_1   /entrypoint.sh arangod         Up       0.0.0.0:8529->8529/tcp
eventstorebenchmarks_php_1        docker-php-entrypoint php -a   Exit 0                         

[32mDocker Info(B[m
Containers: 43
 Running: 1
 Paused: 0
 Stopped: 42
Images: 31
Server Version: 17.09.0-ce
Storage Driver: overlay2
 Backing Filesystem: extfs
 Supports d_type: true
 Native Overlay Diff: true
Logging Driver: json-file
Cgroup Driver: cgroupfs
Plugins:
 Volume: local
 Network: bridge host macvlan null overlay
 Log: awslogs fluentd gcplogs gelf journald json-file logentries splunk syslog
Swarm: inactive
Runtimes: runc
Default Runtime: runc
Init Binary: docker-init
containerd version: 06b9cb35161009dcb7123345749fef02f7cea8e0
runc version: 3f2f8b84a77f73d38244dd690525642a72156c64
init version: 949e6fa
Security Options:
 apparmor
 seccomp
  Profile: default
Kernel Version: 4.10.0-33-generic
Operating System: Ubuntu 17.04
OSType: linux
Architecture: x86_64
CPUs: 8
Total Memory: 31.18GiB
Name: codebook
ID: QODG:6EEM:6T3U:CWGU:KMA6:NNP7:KM72:RYVB:2YGB:BW3E:454Y:EGKH
Docker Root Dir: /var/lib/docker
Debug Mode (client): false
Debug Mode (server): false
Registry: https://index.docker.io/v1/
Experimental: false
Insecure Registries:
 127.0.0.0/8
Live Restore Enabled: false


[32mHardware Info(B[m
Architecture:          x86_64
CPU op-mode(s):        32-bit, 64-bit
Byte Order:            Little Endian
CPU(s):                8
On-line CPU(s) list:   0-7
Thread(s) pro Kern:    2
Kern(e) pro Socket:    4
Socket(s):             1
NUMA-Knoten:           1
Anbieterkennung:       GenuineIntel
Prozessorfamilie:      6
Modell:                158
Model name:            Intel(R) Core(TM) i7-7700HQ CPU @ 2.80GHz
Stepping:              9
CPU MHz:               1095.800
CPU max MHz:           3800,0000
CPU min MHz:           800,0000
BogoMIPS:              5616.00
Virtualisierung:       VT-x
L1d Cache:             32K
L1i Cache:             32K
L2 Cache:              256K
L3 Cache:              6144K
NUMA node0 CPU(s):     0-7
Flags:                 fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx pdpe1gb rdtscp lm constant_tsc art arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf tsc_known_freq pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 sdbg fma cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic movbe popcnt tsc_deadline_timer aes xsave avx f16c rdrand lahf_lm abm 3dnowprefetch epb intel_pt tpr_shadow vnmi flexpriority ept vpid fsgsbase tsc_adjust bmi1 avx2 smep bmi2 erms invpcid mpx rdseed adx smap clflushopt xsaveopt xsavec xgetbv1 xsaves dtherm ida arat pln pts hwp hwp_notify hwp_act_window hwp_epp
[32mUsing 4 CPUs for each service and 12885 MB memory for database.(B[m
[32mWaiting for arangodb database, lean back to enjoy the timer.(B[m
19 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1 0 
[32mStarting benchmark warmup arangodb!(B[m
arangodb: set up event store tables on database _system

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using arangodb took 1.9251689910889 seconds
test 1 using arangodb writes 519.43491954668 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using arangodb took 1.09392786026 seconds
test 2 using arangodb writes 914.13706180069 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using arangodb took 0.28149795532227 seconds
test 3 using arangodb writes 8881.0591790549 events per second

test 4 load one stream with 2500 events

test 4 using arangodb took 0.010924100875854 seconds
test 4 using arangodb loads 228851.78637683 events per second

test 5 project 1 stream with 2500 events

test 5 using arangodb took 0.085539102554321 seconds
test 5 using arangodb loads 29226.399685599 events per second

test 6 project 10 stream with 100 events

test 6 using arangodb took 0.1423180103302 seconds
test 6 using arangodb loads 7026.5175692089 events per second

test 7 real world test

arangodb: destroying event-store tables on database _system
arangodb: set up event store tables on database _system

starting benchmarks for arangodb

Writer 139937820097256 started
Writer 139937819613928 started
Writer 139937819130600 started
Writer 139937818970856 started
Writer 139937794173672 started
Writer 139937705040616 started
Writer 139937704557288 started
Writer 139937704073960 started
Writer 139937703914216 started
Writer 139937661131496 started
Writer 139937660648168 started
Writer 139937660164840 started
Writer 139937659939560 started
Writer 139937642322664 started
Writer 139937641839336 started
Writer 139937641356008 started
Writer 139937621998312 started
Writer 139937621514984 started
Writer 139937621031656 started
Writer 139937620548328 started
Writer 139937620065000 started
Writer 139937600703208 started
Writer 139937600219880 started
Writer 139937599671016 started
Writer 139937599187688 started
Writer 139937599027944 started
Writer 139937581439720 started
Writer 139937580956392 started
Writer 139937580473064 started
Writer 139937563212520 started
Writer 139937562729192 started
Writer 139937562245864 started
Writer 139937561762536 started
Writer 139937561279208 started
Writer 139937539754728 started
Writer 139937539271400 started
Writer 139937538788072 started
Writer 139937538304744 started
Writer 139937521011432 started
Writer 139937520528104 started
Writer 139937520044776 started
Writer 139937519561448 started
Writer 139937519401704 started
Writer 139937501813480 started
Writer 139937501330152 started
Writer 139937500846824 started
Writer 139937483520744 started
Writer 139937483037416 started
Writer 139937482554088 started
Writer 139937482070760 started
Projection 139937481587432 started
Projection 139937460128488 started
Projection 139937459645160 started
Projection 139937459161832 started
Projection 139937458678504 started
Projection 139937458518760 started
Writer 139937620548328 wrote 250 events
Writer 139937620548328 used 37.085784912109 seconds, avg 6.7411273778479 events/second
Writer 139937705040616 wrote 250 events
Writer 139937705040616 used 37.162967920303 seconds, avg 6.7271268682342 events/second
Writer 139937500846824 wrote 250 events
Writer 139937500846824 used 37.203054904938 seconds, avg 6.7198782637288 events/second
Writer 139937641356008 wrote 250 events
Writer 139937641356008 used 37.500091075897 seconds, avg 6.6666504754354 events/second
Writer 139937580956392 wrote 250 events
Writer 139937580956392 used 38.353491067886 seconds, avg 6.5183114506446 events/second
Writer 139937819130600 wrote 250 events
Writer 139937819130600 used 38.515635967255 seconds, avg 6.4908703626897 events/second
Writer 139937820097256 wrote 250 events
Writer 139937820097256 used 39.234461069107 seconds, avg 6.3719493829583 events/second
Writer 139937501813480 wrote 250 events
Writer 139937501813480 used 39.240592956543 seconds, avg 6.370953677404 events/second
Writer 139937562729192 wrote 250 events
Writer 139937562729192 used 39.373651027679 seconds, avg 6.3494238780206 events/second
Writer 139937621031656 wrote 250 events
Writer 139937621031656 used 39.416027069092 seconds, avg 6.3425976332363 events/second
Writer 139937660648168 wrote 250 events
Writer 139937660648168 used 39.715944051743 seconds, avg 6.2947011828372 events/second
Writer 139937520528104 wrote 250 events
Writer 139937520528104 used 39.844124078751 seconds, avg 6.2744508953411 events/second
Writer 139937521011432 wrote 250 events
Writer 139937521011432 used 39.916817903519 seconds, avg 6.2630242872632 events/second
Writer 139937483520744 wrote 250 events
Writer 139937483520744 used 40.00012588501 seconds, avg 6.2499803305291 events/second
Writer 139937580473064 wrote 250 events
Writer 139937580473064 used 40.08597779274 seconds, avg 6.2365947836572 events/second
Writer 139937794173672 wrote 250 events
Writer 139937794173672 used 40.392702102661 seconds, avg 6.1892368419574 events/second
Writer 139937519561448 wrote 250 events
Writer 139937519561448 used 40.409222126007 seconds, avg 6.186706569615 events/second
Writer 139937482554088 wrote 250 events
Writer 139937482554088 used 40.469122886658 seconds, avg 6.1775492565079 events/second
Writer 139937818970856 wrote 250 events
Writer 139937818970856 used 40.608871221542 seconds, avg 6.1562903001199 events/second
Writer 139937661131496 wrote 250 events
Writer 139937661131496 used 40.597244977951 seconds, avg 6.1580533392298 events/second
Writer 139937819613928 wrote 250 events
Writer 139937819613928 used 40.681269884109 seconds, avg 6.1453342216746 events/second
Writer 139937562245864 wrote 250 events
Writer 139937562245864 used 40.685333967209 seconds, avg 6.1447203604496 events/second
Writer 139937599187688 wrote 250 events
Writer 139937599187688 used 40.704490184784 seconds, avg 6.1418285517172 events/second
Writer 139937703914216 wrote 250 events
Writer 139937703914216 used 40.762702941895 seconds, avg 6.1330574755154 events/second
Writer 139937599671016 wrote 250 events
Writer 139937599671016 used 40.72715306282 seconds, avg 6.1384108929584 events/second
Writer 139937561762536 wrote 250 events
Writer 139937561762536 used 40.738545179367 seconds, avg 6.1366943492773 events/second
Writer 139937483037416 wrote 250 events
Writer 139937483037416 used 40.70535993576 seconds, avg 6.1416973193343 events/second
Writer 139937581439720 wrote 250 events
Writer 139937581439720 used 40.83503484726 seconds, avg 6.1221938694336 events/second
Writer 139937539754728 wrote 250 events
Writer 139937539754728 used 40.871078014374 seconds, avg 6.1167948619334 events/second
Writer 139937659939560 wrote 250 events
Writer 139937659939560 used 40.930847883224 seconds, avg 6.1078627228356 events/second
Writer 139937538788072 wrote 250 events
Writer 139937538788072 used 40.968422889709 seconds, avg 6.1022607746708 events/second
Writer 139937482070760 wrote 250 events
Writer 139937482070760 used 40.988193035126 seconds, avg 6.0993174250389 events/second
Writer 139937704557288 wrote 250 events
Writer 139937704557288 used 41.16363286972 seconds, avg 6.073322070266 events/second
Writer 139937704073960 wrote 250 events
Writer 139937704073960 used 41.162621974945 seconds, avg 6.0734712223184 events/second
Writer 139937561279208 wrote 250 events
Writer 139937561279208 used 41.161493062973 seconds, avg 6.0736377958284 events/second
Writer 139937641839336 wrote 250 events
Writer 139937641839336 used 41.210579156876 seconds, avg 6.0664034603428 events/second
Writer 139937621514984 wrote 250 events
Writer 139937621514984 used 41.239624977112 seconds, avg 6.0621307817118 events/second
Writer 139937600219880 wrote 250 events
Writer 139937600219880 used 41.228052139282 seconds, avg 6.0638324399954 events/second
Writer 139937620065000 wrote 250 events
Writer 139937620065000 used 41.23900604248 seconds, avg 6.062221765056 events/second
Writer 139937660164840 wrote 250 events
Writer 139937660164840 used 41.302398204803 seconds, avg 6.0529172848594 events/second
Writer 139937501330152 wrote 250 events
Writer 139937501330152 used 41.221964120865 seconds, avg 6.0647279995438 events/second
Writer 139937600703208 wrote 250 events
Writer 139937600703208 used 41.324888944626 seconds, avg 6.0496230331071 events/second
Writer 139937642322664 wrote 250 events
Writer 139937642322664 used 41.347274065018 seconds, avg 6.0463478101816 events/second
Writer 139937519401704 wrote 250 events
Writer 139937519401704 used 41.354787826538 seconds, avg 6.0452492477684 events/second
Writer 139937599027944 wrote 250 events
Writer 139937599027944 used 41.404184103012 seconds, avg 6.038037107023 events/second
Writer 139937563212520 wrote 250 events
Writer 139937563212520 used 41.431215047836 seconds, avg 6.0340977137975 events/second
Writer 139937520044776 wrote 250 events
Writer 139937520044776 used 41.405311107635 seconds, avg 6.0378727586447 events/second
Writer 139937538304744 wrote 250 events
Writer 139937538304744 used 41.583801031113 seconds, avg 6.0119564301722 events/second
Writer 139937539271400 wrote 250 events
Writer 139937539271400 used 41.617222070694 seconds, avg 6.0071284809768 events/second
Writer 139937621998312 wrote 250 events
Writer 139937621998312 used 41.718451976776 seconds, avg 5.9925521718584 events/second
Projection 139937481587432 read 2500 events
projection 139937481587432 used 41.923307180405 seconds, avg 59.632699997688 events/second
Projection 139937459161832 read 2500 events
projection 139937459161832 used 42.026283979416 seconds, avg 59.486582283232 events/second
Projection 139937460128488 read 2500 events
projection 139937460128488 used 42.037692070007 seconds, avg 59.470438953609 events/second
Projection 139937458678504 read 2500 events
projection 139937458678504 used 42.050789117813 seconds, avg 59.451916419351 events/second
Projection 139937459645160 read 2500 events
projection 139937459645160 used 42.058527946472 seconds, avg 59.4409771826 events/second
Projection 139937458518760 read 12500 events
projection 139937458518760 used 43.047772884369 seconds, avg 290.37506849835 events/second

done.
arangodb avg writes 299.29129646812 events/second
arangodb avg reads 580.52899604137 events/second

all finished
arangodb: destroying event-store tables on database _system

[32mStarting benchmark arangodb!(B[m
arangodb: set up event store tables on database _system

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using arangodb took 2.0085740089417 seconds
test 1 using arangodb writes 497.86564774226 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using arangodb took 1.1474459171295 seconds
test 2 using arangodb writes 871.50076972833 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using arangodb took 0.28382611274719 seconds
test 3 using arangodb writes 8808.2099839305 events per second

test 4 load one stream with 2500 events

test 4 using arangodb took 0.01024317741394 seconds
test 4 using arangodb loads 244064.89304751 events per second

test 5 project 1 stream with 2500 events

test 5 using arangodb took 0.086654186248779 seconds
test 5 using arangodb loads 28850.308429677 events per second

test 6 project 10 stream with 100 events

test 6 using arangodb took 0.14379000663757 seconds
test 6 using arangodb loads 6954.5862287949 events per second

test 7 real world test

arangodb: destroying event-store tables on database _system
arangodb: set up event store tables on database _system

starting benchmarks for arangodb

Writer 139949860133608 started
Writer 139949859650280 started
Writer 139949859166952 started
Writer 139949859007208 started
Writer 139949833886440 started
Writer 139949745113832 started
Writer 139949744630504 started
Writer 139949744147176 started
Writer 139949743663848 started
Writer 139949697010408 started
Writer 139949696527080 started
Writer 139949696043752 started
Writer 139949695494888 started
Writer 139949678201576 started
Writer 139949677718248 started
Writer 139949677234920 started
Writer 139949676751592 started
Writer 139949676591848 started
Writer 139949659003624 started
Writer 139949658520296 started
Writer 139949658036968 started
Writer 139949638679272 started
Writer 139949638195944 started
Writer 139949637647080 started
Writer 139949637163752 started
Writer 139949636680424 started
Writer 139949617318632 started
Writer 139949616835304 started
Writer 139949616351976 started
Writer 139949615868648 started
Writer 139949615708904 started
Writer 139949598120680 started
Writer 139949597637352 started
Writer 139949597154024 started
Writer 139949596928744 started
Writer 139949579311848 started
Writer 139949578828520 started
Writer 139949578345192 started
Writer 139949558987496 started
Writer 139949558504168 started
Writer 139949558020840 started
Writer 139949557537512 started
Writer 139949557054184 started
Writer 139949537692392 started
Writer 139949537209064 started
Writer 139949536725736 started
Writer 139949536176872 started
Writer 139949536017128 started
Writer 139949518428904 started
Writer 139949517945576 started
Projection 139949517462248 started
Projection 139949500201704 started
Projection 139949499718376 started
Projection 139949499235048 started
Projection 139949498751720 started
Projection 139949498268392 started
Writer 139949536017128 wrote 250 events
Writer 139949536017128 used 37.819671869278 seconds, avg 6.6103164740327 events/second
Writer 139949695494888 wrote 250 events
Writer 139949695494888 used 38.172049045563 seconds, avg 6.549294739237 events/second
Writer 139949744630504 wrote 250 events
Writer 139949744630504 used 38.374152898788 seconds, avg 6.5148017901365 events/second
Writer 139949517945576 wrote 250 events
Writer 139949517945576 used 38.33082818985 seconds, avg 6.5221653641755 events/second
Writer 139949557537512 wrote 250 events
Writer 139949557537512 used 38.449547052383 seconds, avg 6.5020271801746 events/second
Writer 139949596928744 wrote 250 events
Writer 139949596928744 used 38.844367980957 seconds, avg 6.4359394423037 events/second
Writer 139949676751592 wrote 250 events
Writer 139949676751592 used 39.349442005157 seconds, avg 6.3533302446127 events/second
Writer 139949678201576 wrote 250 events
Writer 139949678201576 used 39.359176874161 seconds, avg 6.3517588490049 events/second
Writer 139949638679272 wrote 250 events
Writer 139949638679272 used 39.623121976852 seconds, avg 6.3094473006455 events/second
Writer 139949677234920 wrote 250 events
Writer 139949677234920 used 39.891816854477 seconds, avg 6.266949457629 events/second
Writer 139949658036968 wrote 250 events
Writer 139949658036968 used 39.884318113327 seconds, avg 6.2681277210169 events/second
Writer 139949558020840 wrote 250 events
Writer 139949558020840 used 39.936448097229 seconds, avg 6.2599457866496 events/second
Writer 139949536725736 wrote 250 events
Writer 139949536725736 used 40.111445903778 seconds, avg 6.2326349591016 events/second
Writer 139949617318632 wrote 250 events
Writer 139949617318632 used 40.407068014145 seconds, avg 6.1870363846366 events/second
Writer 139949636680424 wrote 250 events
Writer 139949636680424 used 40.502562999725 seconds, avg 6.172448889264 events/second
Writer 139949696527080 wrote 250 events
Writer 139949696527080 used 40.69870018959 seconds, avg 6.1427023181429 events/second
Writer 139949518428904 wrote 250 events
Writer 139949518428904 used 40.593783140182 seconds, avg 6.1585784980098 events/second
Writer 139949833886440 wrote 250 events
Writer 139949833886440 used 40.734538793564 seconds, avg 6.1372979148472 events/second
Writer 139949558504168 wrote 250 events
Writer 139949558504168 used 40.638444900513 seconds, avg 6.1518102036637 events/second
Writer 139949745113832 wrote 250 events
Writer 139949745113832 used 40.84992814064 seconds, avg 6.1199618060352 events/second
Writer 139949860133608 wrote 250 events
Writer 139949860133608 used 40.993863105774 seconds, avg 6.0984737972838 events/second
Writer 139949637163752 wrote 250 events
Writer 139949637163752 used 40.923271179199 seconds, avg 6.108993557853 events/second
Writer 139949659003624 wrote 250 events
Writer 139949659003624 used 40.943102121353 seconds, avg 6.1060346443465 events/second
Writer 139949615708904 wrote 250 events
Writer 139949615708904 used 40.932504177094 seconds, avg 6.1076155741262 events/second
Writer 139949677718248 wrote 250 events
Writer 139949677718248 used 41.078449010849 seconds, avg 6.0859162412382 events/second
Writer 139949537209064 wrote 250 events
Writer 139949537209064 used 41.036206007004 seconds, avg 6.0921811328594 events/second
Writer 139949597637352 wrote 250 events
Writer 139949597637352 used 41.073794126511 seconds, avg 6.0866059568293 events/second
Writer 139949536176872 wrote 250 events
Writer 139949536176872 used 41.050693035126 seconds, avg 6.0900311667353 events/second
Writer 139949658520296 wrote 250 events
Writer 139949658520296 used 41.126119852066 seconds, avg 6.0788618255082 events/second
Writer 139949859166952 wrote 250 events
Writer 139949859166952 used 41.20948600769 seconds, avg 6.0665643816413 events/second
Writer 139949696043752 wrote 250 events
Writer 139949696043752 used 41.188244104385 seconds, avg 6.0696930747136 events/second
Writer 139949616835304 wrote 250 events
Writer 139949616835304 used 41.226321935654 seconds, avg 6.0640869294671 events/second
Writer 139949557054184 wrote 250 events
Writer 139949557054184 used 41.189461946487 seconds, avg 6.0695136130886 events/second
Writer 139949537692392 wrote 250 events
Writer 139949537692392 used 41.244066953659 seconds, avg 6.0614778916176 events/second
Writer 139949697010408 wrote 250 events
Writer 139949697010408 used 41.401292085648 seconds, avg 6.0384588839117 events/second
Writer 139949615868648 wrote 250 events
Writer 139949615868648 used 41.388798236847 seconds, avg 6.0402816861069 events/second
Writer 139949616351976 wrote 250 events
Writer 139949616351976 used 41.42373418808 seconds, avg 6.0351874330041 events/second
Writer 139949578828520 wrote 250 events
Writer 139949578828520 used 41.403188943863 seconds, avg 6.0381822361308 events/second
Writer 139949579311848 wrote 250 events
Writer 139949579311848 used 41.413390159607 seconds, avg 6.0366948717915 events/second
Writer 139949598120680 wrote 250 events
Writer 139949598120680 used 41.468426942825 seconds, avg 6.0286829868104 events/second
Writer 139949558987496 wrote 250 events
Writer 139949558987496 used 41.453009128571 seconds, avg 6.0309252634616 events/second
Writer 139949859650280 wrote 250 events
Writer 139949859650280 used 41.583148002625 seconds, avg 6.0120508429093 events/second
Writer 139949676591848 wrote 250 events
Writer 139949676591848 used 41.571512937546 seconds, avg 6.0137335000432 events/second
Writer 139949859007208 wrote 250 events
Writer 139949859007208 used 41.662127971649 seconds, avg 6.000653643283 events/second
Writer 139949637647080 wrote 250 events
Writer 139949637647080 used 41.609723091125 seconds, avg 6.0082110965386 events/second
Writer 139949743663848 wrote 250 events
Writer 139949743663848 used 41.696922779083 seconds, avg 5.9956462812505 events/second
Writer 139949597154024 wrote 250 events
Writer 139949597154024 used 41.664322137833 seconds, avg 6.0003376311502 events/second
Writer 139949638195944 wrote 250 events
Writer 139949638195944 used 41.721333026886 seconds, avg 5.9921383585442 events/second
Writer 139949578345192 wrote 250 events
Writer 139949578345192 used 41.682277917862 seconds, avg 5.9977528217782 events/second
Writer 139949744147176 wrote 250 events
Writer 139949744147176 used 41.950025081635 seconds, avg 5.9594720030203 events/second
Projection 139949500201704 read 2500 events
projection 139949500201704 used 42.017259120941 seconds, avg 59.499359365733 events/second
Projection 139949517462248 read 2500 events
projection 139949517462248 used 42.12881398201 seconds, avg 59.341808223407 events/second
Projection 139949498751720 read 2500 events
projection 139949498751720 used 42.139733076096 seconds, avg 59.32643179029 events/second
Projection 139949499235048 read 2500 events
projection 139949499235048 used 42.163045167923 seconds, avg 59.293630003318 events/second
Projection 139949499718376 read 2500 events
projection 139949499718376 used 42.218844175339 seconds, avg 59.215263914314 events/second
Projection 139949498268392 read 12500 events
projection 139949498268392 used 46.516852140427 seconds, avg 268.71981711627 events/second

done.
arangodb avg writes 297.75427033297 events/second
arangodb avg reads 537.23978754288 events/second

all finished
arangodb: destroying event-store tables on database _system
             Name                          Command              State             Ports         
------------------------------------------------------------------------------------------------
eventstorebenchmarks_mariadb_1   docker-entrypoint.sh mysqld    Up       0.0.0.0:32772->3306/tcp
eventstorebenchmarks_php_1       docker-php-entrypoint php -a   Exit 0                          

[32mDocker Info(B[m
Containers: 43
 Running: 1
 Paused: 0
 Stopped: 42
Images: 31
Server Version: 17.09.0-ce
Storage Driver: overlay2
 Backing Filesystem: extfs
 Supports d_type: true
 Native Overlay Diff: true
Logging Driver: json-file
Cgroup Driver: cgroupfs
Plugins:
 Volume: local
 Network: bridge host macvlan null overlay
 Log: awslogs fluentd gcplogs gelf journald json-file logentries splunk syslog
Swarm: inactive
Runtimes: runc
Default Runtime: runc
Init Binary: docker-init
containerd version: 06b9cb35161009dcb7123345749fef02f7cea8e0
runc version: 3f2f8b84a77f73d38244dd690525642a72156c64
init version: 949e6fa
Security Options:
 apparmor
 seccomp
  Profile: default
Kernel Version: 4.10.0-33-generic
Operating System: Ubuntu 17.04
OSType: linux
Architecture: x86_64
CPUs: 8
Total Memory: 31.18GiB
Name: codebook
ID: QODG:6EEM:6T3U:CWGU:KMA6:NNP7:KM72:RYVB:2YGB:BW3E:454Y:EGKH
Docker Root Dir: /var/lib/docker
Debug Mode (client): false
Debug Mode (server): false
Registry: https://index.docker.io/v1/
Experimental: false
Insecure Registries:
 127.0.0.0/8
Live Restore Enabled: false


[32mHardware Info(B[m
Architecture:          x86_64
CPU op-mode(s):        32-bit, 64-bit
Byte Order:            Little Endian
CPU(s):                8
On-line CPU(s) list:   0-7
Thread(s) pro Kern:    2
Kern(e) pro Socket:    4
Socket(s):             1
NUMA-Knoten:           1
Anbieterkennung:       GenuineIntel
Prozessorfamilie:      6
Modell:                158
Model name:            Intel(R) Core(TM) i7-7700HQ CPU @ 2.80GHz
Stepping:              9
CPU MHz:               3478.125
CPU max MHz:           3800,0000
CPU min MHz:           800,0000
BogoMIPS:              5616.00
Virtualisierung:       VT-x
L1d Cache:             32K
L1i Cache:             32K
L2 Cache:              256K
L3 Cache:              6144K
NUMA node0 CPU(s):     0-7
Flags:                 fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx pdpe1gb rdtscp lm constant_tsc art arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf tsc_known_freq pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 sdbg fma cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic movbe popcnt tsc_deadline_timer aes xsave avx f16c rdrand lahf_lm abm 3dnowprefetch epb intel_pt tpr_shadow vnmi flexpriority ept vpid fsgsbase tsc_adjust bmi1 avx2 smep bmi2 erms invpcid mpx rdseed adx smap clflushopt xsaveopt xsavec xgetbv1 xsaves dtherm ida arat pln pts hwp hwp_notify hwp_act_window hwp_epp
[32mUsing 4 CPUs for each service and 12828 MB memory for database.(B[m
[32mWaiting for mariadb database, lean back to enjoy the timer.(B[m
19 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1 0 
[32mStarting benchmark warmup mariadb!(B[m
mariadb: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using mariadb took 11.067580938339 seconds
test 1 using mariadb writes 90.353981197092 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using mariadb took 2.6122400760651 seconds
test 2 using mariadb writes 382.81320662776 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using mariadb took 0.79363203048706 seconds
test 3 using mariadb writes 3150.0744727575 events per second

test 4 load one stream with 2500 events

test 4 using mariadb took 0.009688138961792 seconds
test 4 using mariadb loads 258047.49600098 events per second

test 5 project 1 stream with 2500 events

test 5 using mariadb took 0.13460898399353 seconds
test 5 using mariadb loads 18572.311637982 events per second

test 6 project 10 stream with 100 events

test 6 using mariadb took 0.20382714271545 seconds
test 6 using mariadb loads 4906.117932468 events per second

test 7 real world test

mariadb: destroying event-store tables on database event_store_tests
mariadb: set up event store tables on database event_store_tests

starting benchmarks for mariadb

Writer 140437887556328 started
Writer 140437887073000 started
Writer 140437886589672 started
Writer 140437886429928 started
Writer 140437773032168 started
Writer 140437772548840 started
Writer 140437772065512 started
Writer 140437771905768 started
Writer 140437743803112 started
Writer 140437743319784 started
Writer 140437742836456 started
Writer 140437733964520 started
Writer 140437733481192 started
Writer 140437732997864 started
Writer 140437732514536 started
Writer 140437732031208 started
Writer 140437721058024 started
Writer 140437720574696 started
Writer 140437720091368 started
Writer 140437719608040 started
Writer 140437719448296 started
Writer 140437710248680 started
Writer 140437709765352 started
Writer 140437709282024 started
Writer 140437700410088 started
Writer 140437699926760 started
Writer 140437699443432 started
Writer 140437698960104 started
Writer 140437698476776 started
Writer 140437687503592 started
Writer 140437687020264 started
Writer 140437686536936 started
Writer 140437686053608 started
Writer 140437685893864 started
Writer 140437676694248 started
Writer 140437676210920 started
Writer 140437675727592 started
Writer 140437666855656 started
Writer 140437666372328 started
Writer 140437665889000 started
Writer 140437665405672 started
Writer 140437664922344 started
Writer 140437653949160 started
Writer 140437653465832 started
Writer 140437652982504 started
Writer 140437652499176 started
Writer 140437652339432 started
Writer 140437643139816 started
Writer 140437642656488 started
Writer 140437642107624 started
Projection 140437641947880 started
Projection 140437632719592 started
Projection 140437632236264 started
Projection 140437631752936 started
Projection 140437622881000 started
Projection 140437622397672 started
Writer 140437699443432 wrote 250 events
Writer 140437699443432 used 149.11103582382 seconds, avg 1.6766029329672 events/second
Writer 140437643139816 wrote 250 events
Writer 140437643139816 used 157.339427948 seconds, avg 1.5889215008626 events/second
Writer 140437698960104 wrote 250 events
Writer 140437698960104 used 157.38443517685 seconds, avg 1.5884671169616 events/second
Writer 140437721058024 wrote 250 events
Writer 140437721058024 used 157.51472616196 seconds, avg 1.5871531893656 events/second
Writer 140437664922344 wrote 250 events
Writer 140437664922344 used 159.46751213074 seconds, avg 1.5677174407477 events/second
Writer 140437652982504 wrote 250 events
Writer 140437652982504 used 162.76139307022 seconds, avg 1.5359907855553 events/second
Writer 140437665405672 wrote 250 events
Writer 140437665405672 used 163.86811614037 seconds, avg 1.5256170992157 events/second
Writer 140437687020264 wrote 250 events
Writer 140437687020264 used 165.17887496948 seconds, avg 1.5135107322059 events/second
Writer 140437732031208 wrote 250 events
Writer 140437732031208 used 165.87625193596 seconds, avg 1.5071476301292 events/second
Writer 140437653949160 wrote 250 events
Writer 140437653949160 used 166.81587004662 seconds, avg 1.4986583706343 events/second
Writer 140437720091368 wrote 250 events
Writer 140437720091368 used 167.56437706947 seconds, avg 1.4919638909668 events/second
Writer 140437698476776 wrote 250 events
Writer 140437698476776 used 167.97271490097 seconds, avg 1.4883369608415 events/second
Writer 140437699926760 wrote 250 events
Writer 140437699926760 used 169.75089597702 seconds, avg 1.4727462766019 events/second
Writer 140437887556328 wrote 250 events
Writer 140437887556328 used 170.49509000778 seconds, avg 1.4663178862722 events/second
Writer 140437685893864 wrote 250 events
Writer 140437685893864 used 170.56009101868 seconds, avg 1.4657590677096 events/second
Writer 140437886429928 wrote 250 events
Writer 140437886429928 used 172.37441802025 seconds, avg 1.4503312200923 events/second
Writer 140437733481192 wrote 250 events
Writer 140437733481192 used 172.52207803726 seconds, avg 1.4490898953003 events/second
Writer 140437686053608 wrote 250 events
Writer 140437686053608 used 173.87932395935 seconds, avg 1.4377787669478 events/second
Writer 140437732514536 wrote 250 events
Writer 140437732514536 used 173.91952204704 seconds, avg 1.4374464525746 events/second
Writer 140437772065512 wrote 250 events
Writer 140437772065512 used 173.93666195869 seconds, avg 1.4373048050064 events/second
Writer 140437771905768 wrote 250 events
Writer 140437771905768 used 174.81902909279 seconds, avg 1.4300502713998 events/second
Writer 140437733964520 wrote 250 events
Writer 140437733964520 used 176.35995602608 seconds, avg 1.4175553545899 events/second
Writer 140437665889000 wrote 250 events
Writer 140437665889000 used 176.3908560276 seconds, avg 1.4173070284373 events/second
Writer 140437732997864 wrote 250 events
Writer 140437732997864 used 177.97337388992 seconds, avg 1.4047045045886 events/second
Writer 140437743319784 wrote 250 events
Writer 140437743319784 used 178.54630494118 seconds, avg 1.4001969969771 events/second
Writer 140437742836456 wrote 250 events
Writer 140437742836456 used 179.54985809326 seconds, avg 1.3923709138781 events/second
Writer 140437675727592 wrote 250 events
Writer 140437675727592 used 179.52670097351 seconds, avg 1.3925505155742 events/second
Writer 140437710248680 wrote 250 events
Writer 140437710248680 used 179.63381409645 seconds, avg 1.3917201572404 events/second
Writer 140437886589672 wrote 250 events
Writer 140437886589672 used 180.33332085609 seconds, avg 1.3863217225368 events/second
Writer 140437676694248 wrote 250 events
Writer 140437676694248 used 180.58148694038 seconds, avg 1.3844165547409 events/second
Writer 140437743803112 wrote 250 events
Writer 140437743803112 used 180.65187883377 seconds, avg 1.3838771100191 events/second
Writer 140437653465832 wrote 250 events
Writer 140437653465832 used 180.72418785095 seconds, avg 1.3833234110654 events/second
Writer 140437666855656 wrote 250 events
Writer 140437666855656 used 181.81300616264 seconds, avg 1.3750391420092 events/second
Writer 140437652499176 wrote 250 events
Writer 140437652499176 used 181.79299998283 seconds, avg 1.3751904640091 events/second
Writer 140437700410088 wrote 250 events
Writer 140437700410088 used 181.96011281013 seconds, avg 1.3739274841012 events/second
Writer 140437642656488 wrote 250 events
Writer 140437642656488 used 183.09888601303 seconds, avg 1.3653824195425 events/second
Writer 140437719608040 wrote 250 events
Writer 140437719608040 used 184.17365694046 seconds, avg 1.3574145409993 events/second
Writer 140437709282024 wrote 250 events
Writer 140437709282024 used 184.70437502861 seconds, avg 1.3535142303006 events/second
Writer 140437686536936 wrote 250 events
Writer 140437686536936 used 185.39513897896 seconds, avg 1.348471170155 events/second
Writer 140437720574696 wrote 250 events
Writer 140437720574696 used 186.08010482788 seconds, avg 1.3435074116668 events/second
Writer 140437642107624 wrote 250 events
Writer 140437642107624 used 186.01527500153 seconds, avg 1.3439756493006 events/second
Writer 140437772548840 wrote 250 events
Writer 140437772548840 used 186.16118717194 seconds, avg 1.3429222481757 events/second
Writer 140437887073000 wrote 250 events
Writer 140437887073000 used 186.51748418808 seconds, avg 1.340356916609 events/second
Writer 140437773032168 wrote 250 events
Writer 140437773032168 used 186.72661805153 seconds, avg 1.3388557164946 events/second
Writer 140437676210920 wrote 250 events
Writer 140437676210920 used 186.80449390411 seconds, avg 1.3382975686245 events/second
Writer 140437687503592 wrote 250 events
Writer 140437687503592 used 186.85914778709 seconds, avg 1.3379061339017 events/second
Writer 140437652339432 wrote 250 events
Writer 140437652339432 used 186.86420202255 seconds, avg 1.3378699466997 events/second
Writer 140437709765352 wrote 250 events
Writer 140437709765352 used 187.59903001785 seconds, avg 1.3326294916142 events/second
Writer 140437719448296 wrote 250 events
Writer 140437719448296 used 187.78151798248 seconds, avg 1.3313344288937 events/second
Writer 140437666372328 wrote 250 events
Writer 140437666372328 used 187.75593400002 seconds, avg 1.3315158390679 events/second
Error 22001. 
Error-Info: Data too long for column 'position' at row 1
#0 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(827): Prooph\EventStore\Pdo\Exception\RuntimeException::fromStatementErrorInfo(Array)
#1 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(583): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->persist()
#2 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(488): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->handleStreamWithSingleHandler('blog-96ee8959-f...', Object(Prooph\EventStore\Pdo\PdoStreamIterator))
#3 /app/src/AllProjector.php(48): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->run()
#4 [internal function]: Prooph\EventStoreBenchmarks\AllProjector->run()
#5 {main}Projection 140437632236264 read 2500 events
projection 140437632236264 used 188.15846300125 seconds, avg 13.286673159014 events/second
Projection 140437631752936 read 2500 events
projection 140437631752936 used 188.18575787544 seconds, avg 13.284746030859 events/second
Projection 140437641947880 read 2500 events
projection 140437641947880 used 188.24288892746 seconds, avg 13.280714157353 events/second
Projection 140437622881000 read 2500 events
projection 140437622881000 used 188.23974609375 seconds, avg 13.280935890951 events/second
Projection 140437632719592 read 2500 events
projection 140437632719592 used 188.25732088089 seconds, avg 13.279696047421 events/second

done.
mariadb avg writes 66.545589929419 events/second
mariadb avg reads 132.79222030002 events/second

all finished
mariadb: destroying event-store tables on database event_store_tests

[32mStarting benchmark mariadb!(B[m
mariadb: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using mariadb took 11.299973964691 seconds
test 1 using mariadb writes 88.495779116366 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using mariadb took 2.6035430431366 seconds
test 2 using mariadb writes 384.09197905761 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using mariadb took 0.76448798179626 seconds
test 3 using mariadb writes 3270.1625918643 events per second

test 4 load one stream with 2500 events

test 4 using mariadb took 0.0074880123138428 seconds
test 4 using mariadb loads 333866.97233101 events per second

test 5 project 1 stream with 2500 events

test 5 using mariadb took 0.1669590473175 seconds
test 5 using mariadb loads 14973.731823264 events per second

test 6 project 10 stream with 100 events

test 6 using mariadb took 0.22943902015686 seconds
test 6 using mariadb loads 4358.4565490052 events per second

test 7 real world test

mariadb: destroying event-store tables on database event_store_tests
mariadb: set up event store tables on database event_store_tests

starting benchmarks for mariadb

Writer 140200561941224 started
Writer 140200561457896 started
Writer 140200560974568 started
Writer 140200560814824 started
Writer 140200447376104 started
Writer 140200446892776 started
Writer 140200446409448 started
Writer 140200445926120 started
Writer 140200416049896 started
Writer 140200415566568 started
Writer 140200415083240 started
Writer 140200414599912 started
Writer 140200414116584 started
Writer 140200403143400 started
Writer 140200402660072 started
Writer 140200402176744 started
Writer 140200401693416 started
Writer 140200401533672 started
Writer 140200392334056 started
Writer 140200391850728 started
Writer 140200391367400 started
Writer 140200382495464 started
Writer 140200382012136 started
Writer 140200381528808 started
Writer 140200381045480 started
Writer 140200380562152 started
Writer 140200369588968 started
Writer 140200369105640 started
Writer 140200368622312 started
Writer 140200368138984 started
Writer 140200367979240 started
Writer 140200358779624 started
Writer 140200358296296 started
Writer 140200357812968 started
Writer 140200348941032 started
Writer 140200348457704 started
Writer 140200347974376 started
Writer 140200347491048 started
Writer 140200347007720 started
Writer 140200336034536 started
Writer 140200335551208 started
Writer 140200335067880 started
Writer 140200334584552 started
Writer 140200334424808 started
Writer 140200325225192 started
Writer 140200324741864 started
Writer 140200324258536 started
Writer 140200315386600 started
Writer 140200314837736 started
Writer 140200314354408 started
Projection 140200313871080 started
Projection 140200304966376 started
Projection 140200304483048 started
Projection 140200303999720 started
Projection 140200303516392 started
Projection 140200303033064 started
Writer 140200560814824 wrote 250 events
Writer 140200560814824 used 145.98129296303 seconds, avg 1.712548196592 events/second
Writer 140200368622312 wrote 250 events
Writer 140200368622312 used 147.13188910484 seconds, avg 1.6991557813946 events/second
Writer 140200445926120 wrote 250 events
Writer 140200445926120 used 147.25227594376 seconds, avg 1.6977666280383 events/second
Writer 140200382495464 wrote 250 events
Writer 140200382495464 used 153.70707511902 seconds, avg 1.6264703482674 events/second
Writer 140200381528808 wrote 250 events
Writer 140200381528808 used 155.31271290779 seconds, avg 1.6096557411139 events/second
Writer 140200369105640 wrote 250 events
Writer 140200369105640 used 157.81556606293 seconds, avg 1.5841276385899 events/second
Writer 140200324741864 wrote 250 events
Writer 140200324741864 used 157.77731513977 seconds, avg 1.5845116883789 events/second
Writer 140200415083240 wrote 250 events
Writer 140200415083240 used 157.85145497322 seconds, avg 1.5837674733021 events/second
Writer 140200357812968 wrote 250 events
Writer 140200357812968 used 158.73610305786 seconds, avg 1.5749410196171 events/second
Writer 140200414599912 wrote 250 events
Writer 140200414599912 used 159.82410812378 seconds, avg 1.5642195844846 events/second
Writer 140200335067880 wrote 250 events
Writer 140200335067880 used 160.58382582664 seconds, avg 1.5568193042672 events/second
Writer 140200560974568 wrote 250 events
Writer 140200560974568 used 161.64325714111 seconds, avg 1.5466157043702 events/second
Writer 140200324258536 wrote 250 events
Writer 140200324258536 used 162.58788990974 seconds, avg 1.5376298944453 events/second
Writer 140200336034536 wrote 250 events
Writer 140200336034536 used 165.54359102249 seconds, avg 1.510176253009 events/second
Writer 140200416049896 wrote 250 events
Writer 140200416049896 used 166.45311117172 seconds, avg 1.5019244653354 events/second
Writer 140200347974376 wrote 250 events
Writer 140200347974376 used 166.39758181572 seconds, avg 1.5024256799409 events/second
Writer 140200402660072 wrote 250 events
Writer 140200402660072 used 166.44688105583 seconds, avg 1.5019806824505 events/second
Writer 140200392334056 wrote 250 events
Writer 140200392334056 used 166.53074383736 seconds, avg 1.5012243039289 events/second
Writer 140200401533672 wrote 250 events
Writer 140200401533672 used 168.98595094681 seconds, avg 1.4794129251531 events/second
Writer 140200391367400 wrote 250 events
Writer 140200391367400 used 170.14101910591 seconds, avg 1.4693693579229 events/second
Writer 140200368138984 wrote 250 events
Writer 140200368138984 used 172.38511991501 seconds, avg 1.4502411816244 events/second
Writer 140200391850728 wrote 250 events
Writer 140200391850728 used 172.40735816956 seconds, avg 1.4500541198139 events/second
Writer 140200382012136 wrote 250 events
Writer 140200382012136 used 172.40697693825 seconds, avg 1.4500573262157 events/second
Writer 140200335551208 wrote 250 events
Writer 140200335551208 used 172.36820602417 seconds, avg 1.4503834887331 events/second
Writer 140200348457704 wrote 250 events
Writer 140200348457704 used 172.40389990807 seconds, avg 1.4500832065476 events/second
Writer 140200561457896 wrote 250 events
Writer 140200561457896 used 172.48030018806 seconds, avg 1.4494408910897 events/second
Writer 140200314837736 wrote 250 events
Writer 140200314837736 used 174.06812000275 seconds, avg 1.4362193375562 events/second
Writer 140200446892776 wrote 250 events
Writer 140200446892776 used 174.27526497841 seconds, avg 1.4345122357494 events/second
Writer 140200415566568 wrote 250 events
Writer 140200415566568 used 176.04904794693 seconds, avg 1.4200588013141 events/second
Writer 140200334584552 wrote 250 events
Writer 140200334584552 used 175.9812810421 seconds, avg 1.4206056378246 events/second
Writer 140200561941224 wrote 250 events
Writer 140200561941224 used 177.22693705559 seconds, avg 1.4106207789484 events/second
Writer 140200403143400 wrote 250 events
Writer 140200403143400 used 179.22004508972 seconds, avg 1.3949332502112 events/second
Writer 140200402176744 wrote 250 events
Writer 140200402176744 used 179.68134999275 seconds, avg 1.3913519684157 events/second
Writer 140200325225192 wrote 250 events
Writer 140200325225192 used 179.84142994881 seconds, avg 1.390113502051 events/second
Writer 140200401693416 wrote 250 events
Writer 140200401693416 used 179.97728419304 seconds, avg 1.3890641872996 events/second
Writer 140200315386600 wrote 250 events
Writer 140200314354408 wrote 250 events
Writer 140200314354408 used 179.90695214272 seconds, avg 1.3896072220805 events/second
Writer 140200315386600 used 179.91052508354 seconds, avg 1.3895796251159 events/second
Writer 140200367979240 wrote 250 events
Writer 140200367979240 used 179.94890785217 seconds, avg 1.3892832303566 events/second
Writer 140200414116584 wrote 250 events
Writer 140200414116584 used 180.87138986588 seconds, avg 1.3821975945747 events/second
Writer 140200380562152 wrote 250 events
Writer 140200380562152 used 181.05105900764 seconds, avg 1.3808259469471 events/second
Writer 140200447376104 wrote 250 events
Writer 140200447376104 used 181.12878394127 seconds, avg 1.3802334149224 events/second
Writer 140200369588968 wrote 250 events
Writer 140200369588968 used 181.26458001137 seconds, avg 1.379199400039 events/second
Writer 140200348941032 wrote 250 events
Writer 140200358779624 wrote 250 events
Writer 140200446409448 wrote 250 events
Writer 140200358779624 used 181.58494591713 seconds, avg 1.3767661120658 events/second
Writer 140200348941032 used 181.57860398293 seconds, avg 1.376814197908 events/second
Writer 140200446409448 used 181.63629007339 seconds, avg 1.3763769338109 events/second
Writer 140200347491048 wrote 250 events
Writer 140200347491048 used 181.82573199272 seconds, avg 1.374942904176 events/second
Writer 140200334424808 wrote 250 events
Writer 140200334424808 used 182.15956091881 seconds, avg 1.3724231587901 events/second
Writer 140200358296296 wrote 250 events
Writer 140200358296296 used 182.62710809708 seconds, avg 1.3689095918176 events/second
Writer 140200347007720 wrote 250 events
Writer 140200347007720 used 182.77438497543 seconds, avg 1.3678065448482 events/second
Writer 140200381045480 wrote 250 events
Writer 140200381045480 used 183.18374991417 seconds, avg 1.364749876106 events/second
Error 22001. 
Error-Info: Data too long for column 'position' at row 1
#0 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(827): Prooph\EventStore\Pdo\Exception\RuntimeException::fromStatementErrorInfo(Array)
#1 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(583): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->persist()
#2 /app/vendor/prooph/pdo-event-store/src/Projection/PdoEventStoreProjector.php(488): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->handleStreamWithSingleHandler('blog-7b43988d-5...', Object(Prooph\EventStore\Pdo\PdoStreamIterator))
#3 /app/src/AllProjector.php(48): Prooph\EventStore\Pdo\Projection\PdoEventStoreProjector->run()
#4 [internal function]: Prooph\EventStoreBenchmarks\AllProjector->run()
#5 {main}Projection 140200304966376 read 2500 events
Projection 140200303999720 read 2500 events
projection 140200303999720 used 183.53635501862 seconds, avg 13.621279553832 events/second
projection 140200304966376 used 183.54068589211 seconds, avg 13.620958142598 events/second
Projection 140200304483048 read 2500 events
projection 140200304483048 used 183.56334805489 seconds, avg 13.619276541265 events/second
Projection 140200303516392 read 2500 events
Projection 140200313871080 read 2500 events
projection 140200303516392 used 183.56637692451 seconds, avg 13.619051821391 events/second
projection 140200313871080 used 183.57558393478 seconds, avg 13.618368774402 events/second

done.
mariadb avg writes 68.214501669397 events/second
mariadb avg reads 136.18074931568 events/second

all finished
mariadb: destroying event-store tables on database event_store_tests
             Name                            Command              State            Ports         
-------------------------------------------------------------------------------------------------
eventstorebenchmarks_php_1        docker-php-entrypoint php -a    Exit 0                         
eventstorebenchmarks_postgres_1   docker-entrypoint.sh postgres   Up       0.0.0.0:5432->5432/tcp

[32mDocker Info(B[m
Containers: 43
 Running: 1
 Paused: 0
 Stopped: 42
Images: 31
Server Version: 17.09.0-ce
Storage Driver: overlay2
 Backing Filesystem: extfs
 Supports d_type: true
 Native Overlay Diff: true
Logging Driver: json-file
Cgroup Driver: cgroupfs
Plugins:
 Volume: local
 Network: bridge host macvlan null overlay
 Log: awslogs fluentd gcplogs gelf journald json-file logentries splunk syslog
Swarm: inactive
Runtimes: runc
Default Runtime: runc
Init Binary: docker-init
containerd version: 06b9cb35161009dcb7123345749fef02f7cea8e0
runc version: 3f2f8b84a77f73d38244dd690525642a72156c64
init version: 949e6fa
Security Options:
 apparmor
 seccomp
  Profile: default
Kernel Version: 4.10.0-33-generic
Operating System: Ubuntu 17.04
OSType: linux
Architecture: x86_64
CPUs: 8
Total Memory: 31.18GiB
Name: codebook
ID: QODG:6EEM:6T3U:CWGU:KMA6:NNP7:KM72:RYVB:2YGB:BW3E:454Y:EGKH
Docker Root Dir: /var/lib/docker
Debug Mode (client): false
Debug Mode (server): false
Registry: https://index.docker.io/v1/
Experimental: false
Insecure Registries:
 127.0.0.0/8
Live Restore Enabled: false


[32mHardware Info(B[m
Architecture:          x86_64
CPU op-mode(s):        32-bit, 64-bit
Byte Order:            Little Endian
CPU(s):                8
On-line CPU(s) list:   0-7
Thread(s) pro Kern:    2
Kern(e) pro Socket:    4
Socket(s):             1
NUMA-Knoten:           1
Anbieterkennung:       GenuineIntel
Prozessorfamilie:      6
Modell:                158
Model name:            Intel(R) Core(TM) i7-7700HQ CPU @ 2.80GHz
Stepping:              9
CPU MHz:               3585.107
CPU max MHz:           3800,0000
CPU min MHz:           800,0000
BogoMIPS:              5616.00
Virtualisierung:       VT-x
L1d Cache:             32K
L1i Cache:             32K
L2 Cache:              256K
L3 Cache:              6144K
NUMA node0 CPU(s):     0-7
Flags:                 fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx pdpe1gb rdtscp lm constant_tsc art arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf tsc_known_freq pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 sdbg fma cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic movbe popcnt tsc_deadline_timer aes xsave avx f16c rdrand lahf_lm abm 3dnowprefetch epb intel_pt tpr_shadow vnmi flexpriority ept vpid fsgsbase tsc_adjust bmi1 avx2 smep bmi2 erms invpcid mpx rdseed adx smap clflushopt xsaveopt xsavec xgetbv1 xsaves dtherm ida arat pln pts hwp hwp_notify hwp_act_window hwp_epp
[32mUsing 4 CPUs for each service and 12817 MB memory for database.(B[m
[32mWaiting for postgres database, lean back to enjoy the timer.(B[m
19 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1 0 
[32mStarting benchmark warmup postgres!(B[m
postgres: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using postgres took 5.6969017982483 seconds
test 1 using postgres writes 175.53400697682 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using postgres took 1.4618718624115 seconds
test 2 using postgres writes 684.05448227891 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using postgres took 0.26583218574524 seconds
test 3 using postgres writes 9404.4293131452 events per second

test 4 load one stream with 2500 events

test 4 using postgres took 0.014019966125488 seconds
test 4 using postgres loads 178317.12128427 events per second

test 5 project 1 stream with 2500 events

test 5 using postgres took 0.12459397315979 seconds
test 5 using postgres loads 20065.176000077 events per second

test 6 project 10 stream with 100 events

test 6 using postgres took 0.16171312332153 seconds
test 6 using postgres loads 6183.7900317571 events per second

test 7 real world test

postgres: destroying event-store tables on database event_store_tests
postgres: set up event store tables on database event_store_tests

starting benchmarks for postgres

Writer 140445364738792 started
Writer 140445364255464 started
Writer 140445363772136 started
Writer 140445363612392 started
Writer 140445338491624 started
Writer 140445248649960 started
Writer 140445225057000 started
Writer 140445224573672 started
Writer 140445224090344 started
Writer 140445223607016 started
Writer 140445223123688 started
Writer 140445212150504 started
Writer 140445211667176 started
Writer 140445211183848 started
Writer 140445210700520 started
Writer 140445210540776 started
Writer 140445201341160 started
Writer 140445200857832 started
Writer 140445200374504 started
Writer 140445191502568 started
Writer 140445190535912 started
Writer 140445191019240 started
Writer 140445190052584 started
Writer 140445189569256 started
Writer 140445178596072 started
Writer 140445178112744 started
Writer 140445177629416 started
Writer 140445177146088 started
Writer 140445176986344 started
Writer 140445167786728 started
Writer 140445167303400 started
Writer 140445166820072 started
Writer 140445157948136 started
Writer 140445157464808 started
Writer 140445156981480 started
Writer 140445156498152 started
Writer 140445156014824 started
Writer 140445145041640 started
Writer 140445144558312 started
Writer 140445144074984 started
Writer 140445143591656 started
Writer 140445143431912 started
Writer 140445134232296 started
Writer 140445133748968 started
Writer 140445133265640 started
Writer 140445124393704 started
Writer 140445123910376 started
Writer 140445123427048 started
Writer 140445122943720 started
Writer 140445122460392 started
Projection 140445111421672 started
Projection 140445110938344 started
Projection 140445110455016 started
Projection 140445109971688 started
Projection 140445109811944 started
Projection 140445100612328 started
Writer 140445212150504 wrote 250 events
Writer 140445212150504 used 10.740424871445 seconds, avg 23.276546597767 events/second
Writer 140445191502568 wrote 250 events
Writer 140445191502568 used 10.742695808411 seconds, avg 23.271626085165 events/second
Writer 140445134232296 wrote 250 events
Writer 140445134232296 used 10.929502010345 seconds, avg 22.873869254369 events/second
Writer 140445364255464 wrote 250 events
Writer 140445364255464 used 11.087314844131 seconds, avg 22.548290863439 events/second
Writer 140445201341160 wrote 250 events
Writer 140445201341160 used 11.066988945007 seconds, avg 22.589703598898 events/second
Writer 140445178596072 wrote 250 events
Writer 140445178596072 used 11.046865940094 seconds, avg 22.630853072331 events/second
Writer 140445363612392 wrote 250 events
Writer 140445363612392 used 11.09793806076 seconds, avg 22.526707090206 events/second
Writer 140445363772136 wrote 250 events
Writer 140445363772136 used 11.100030183792 seconds, avg 22.522461278082 events/second
Writer 140445124393704 wrote 250 events
Writer 140445124393704 used 10.995273828506 seconds, avg 22.737041741684 events/second
Writer 140445157464808 wrote 250 events
Writer 140445157464808 used 11.0403881073 seconds, avg 22.644131489789 events/second
Writer 140445167303400 wrote 250 events
Writer 140445167303400 used 11.091187000275 seconds, avg 22.540418802226 events/second
Writer 140445156498152 wrote 250 events
Writer 140445156498152 used 11.081731081009 seconds, avg 22.559652293714 events/second
Writer 140445211183848 wrote 250 events
Writer 140445211183848 used 11.151696920395 seconds, avg 22.418112847273 events/second
Writer 140445210700520 wrote 250 events
Writer 140445210700520 used 11.153738975525 seconds, avg 22.414008481693 events/second
Writer 140445122460392 wrote 250 events
Writer 140445122460392 used 11.073345184326 seconds, avg 22.576736825098 events/second
Writer 140445157948136 wrote 250 events
Writer 140445157948136 used 11.111549854279 seconds, avg 22.499111580167 events/second
Writer 140445144074984 wrote 250 events
Writer 140445248649960 wrote 250 events
Writer 140445248649960 used 11.176434993744 seconds, avg 22.368492291141 events/second
Writer 140445144074984 used 11.095866918564 seconds, avg 22.530911900335 events/second
Writer 140445364738792 wrote 250 events
Writer 140445364738792 used 11.194555044174 seconds, avg 22.332285563248 events/second
Writer 140445190052584 wrote 250 events
Writer 140445190052584 used 11.153049945831 seconds, avg 22.415393207617 events/second
Writer 140445190535912 wrote 250 events
Writer 140445190535912 used 11.182230949402 seconds, avg 22.356898290799 events/second
Writer 140445224090344 wrote 250 events
Writer 140445224090344 used 11.258806943893 seconds, avg 22.204839397801 events/second
Writer 140445166820072 wrote 250 events
Writer 140445166820072 used 11.205594062805 seconds, avg 22.310285255632 events/second
Writer 140445133265640 wrote 250 events
Writer 140445133265640 used 11.192096948624 seconds, avg 22.337190353837 events/second
Writer 140445200374504 wrote 250 events
Writer 140445200374504 used 11.252004146576 seconds, avg 22.218264119293 events/second
Writer 140445177629416 wrote 250 events
Writer 140445177629416 used 11.234533071518 seconds, avg 22.252816241541 events/second
Writer 140445145041640 wrote 250 events
Writer 140445145041640 used 11.209030866623 seconds, avg 22.30344469337 events/second
Writer 140445122943720 wrote 250 events
Writer 140445122943720 used 11.191169023514 seconds, avg 22.339042460598 events/second
Writer 140445176986344 wrote 250 events
Writer 140445176986344 used 11.236675977707 seconds, avg 22.248572486738 events/second
Writer 140445156014824 wrote 250 events
Writer 140445156014824 used 11.221257925034 seconds, avg 22.279142113138 events/second
Writer 140445133748968 wrote 250 events
Writer 140445133748968 used 11.257966995239 seconds, avg 22.20649608457 events/second
Writer 140445123910376 wrote 250 events
Writer 140445123910376 used 11.249684095383 seconds, avg 22.222846248866 events/second
Writer 140445211667176 wrote 250 events
Writer 140445211667176 used 11.341482162476 seconds, avg 22.04297431487 events/second
Writer 140445143591656 wrote 250 events
Writer 140445143591656 used 11.276500940323 seconds, avg 22.169997707892 events/second
Writer 140445338491624 wrote 250 events
Writer 140445338491624 used 11.361195087433 seconds, avg 22.004727326312 events/second
Writer 140445210540776 wrote 250 events
Writer 140445210540776 used 11.340323925018 seconds, avg 22.045225661365 events/second
Writer 140445177146088 wrote 250 events
Writer 140445177146088 used 11.320905923843 seconds, avg 22.083038378887 events/second
Writer 140445224573672 wrote 250 events
Writer 140445224573672 used 11.371875047684 seconds, avg 21.98406146319 events/second
Writer 140445156981480 wrote 250 events
Writer 140445156981480 used 11.309105157852 seconds, avg 22.106081472451 events/second
Writer 140445223607016 wrote 250 events
Writer 140445223607016 used 11.37097120285 seconds, avg 21.985808911145 events/second
Writer 140445191019240 wrote 250 events
Writer 140445191019240 used 11.343966960907 seconds, avg 22.038145990863 events/second
Writer 140445178112744 wrote 250 events
Writer 140445178112744 used 11.329932928085 seconds, avg 22.065443951595 events/second
Writer 140445167786728 wrote 250 events
Writer 140445167786728 used 11.327975988388 seconds, avg 22.069255819068 events/second
Writer 140445123427048 wrote 250 events
Writer 140445123427048 used 11.291883945465 seconds, avg 22.139795379353 events/second
Writer 140445143431912 wrote 250 events
Writer 140445143431912 used 11.317224979401 seconds, avg 22.090220920327 events/second
Writer 140445225057000 wrote 250 events
Writer 140445225057000 used 11.399574041367 seconds, avg 21.930643995364 events/second
Writer 140445144558312 wrote 250 events
Writer 140445144558312 used 11.36449098587 seconds, avg 21.998345575779 events/second
Writer 140445223123688 wrote 250 events
Writer 140445223123688 used 11.431432008743 seconds, avg 21.869526040901 events/second
Writer 140445189569256 wrote 250 events
Writer 140445189569256 used 11.458983182907 seconds, avg 21.816944488837 events/second
Writer 140445200857832 wrote 250 events
Writer 140445200857832 used 11.479011058807 seconds, avg 21.778879619441 events/second
Projection 140445109811944 read 2500 events
projection 140445109811944 used 11.571002006531 seconds, avg 216.05734737484 events/second
Projection 140445110938344 read 2500 events
projection 140445110938344 used 11.642954111099 seconds, avg 214.72213805401 events/second
Projection 140445111421672 read 2500 events
projection 140445111421672 used 11.65969991684 seconds, avg 214.41375145422 events/second
Projection 140445110455016 read 2500 events
projection 140445110455016 used 11.707743883133 seconds, avg 213.53388192935 events/second
Projection 140445109971688 read 2500 events
projection 140445109971688 used 11.742468833923 seconds, avg 212.90241731599 events/second
Projection 140445100612328 read 12500 events
projection 140445100612328 used 12.563104867935 seconds, avg 994.97696878291 events/second

done.
postgres avg writes 1084.4643298942 events/second
postgres avg reads 1987.3640102353 events/second

all finished
postgres: destroying event-store tables on database event_store_tests

[32mStarting benchmark postgres!(B[m
postgres: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using postgres took 5.822774887085 seconds
test 1 using postgres writes 171.73942310873 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using postgres took 1.5190620422363 seconds
test 2 using postgres writes 658.30095953673 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using postgres took 0.24573302268982 seconds
test 3 using postgres writes 10173.642812166 events per second

test 4 load one stream with 2500 events

test 4 using postgres took 0.0058999061584473 seconds
test 4 using postgres loads 423735.55322072 events per second

test 5 project 1 stream with 2500 events

test 5 using postgres took 0.13693189620972 seconds
test 5 using postgres loads 18257.251007254 events per second

test 6 project 10 stream with 100 events

test 6 using postgres took 0.18208909034729 seconds
test 6 using postgres loads 5491.8172093273 events per second

test 7 real world test

postgres: destroying event-store tables on database event_store_tests
postgres: set up event store tables on database event_store_tests

starting benchmarks for postgres

Writer 140080394222312 started
Writer 140080393738984 started
Writer 140080393255656 started
Writer 140080393095912 started
Writer 140080366922472 started
Writer 140080278145768 started
Writer 140080277662440 started
Writer 140080277179112 started
Writer 140080276695784 started
Writer 140080246819560 started
Writer 140080246336232 started
Writer 140080245852904 started
Writer 140080245369576 started
Writer 140080245209832 started
Writer 140080236010216 started
Writer 140080235526888 started
Writer 140080235043560 started
Writer 140080226171624 started
Writer 140080225688296 started
Writer 140080225204968 started
Writer 140080224721640 started
Writer 140080224238312 started
Writer 140080213265128 started
Writer 140080212781800 started
Writer 140080212298472 started
Writer 140080211815144 started
Writer 140080211655400 started
Writer 140080202455784 started
Writer 140080201972456 started
Writer 140080201489128 started
Writer 140080192617192 started
Writer 140080192133864 started
Writer 140080191650536 started
Writer 140080191167208 started
Writer 140080190683880 started
Writer 140080179710696 started
Writer 140080179227368 started
Writer 140080178744040 started
Writer 140080178260712 started
Writer 140080178100968 started
Writer 140080168901352 started
Writer 140080168418024 started
Writer 140080167934696 started
Writer 140080159062760 started
Writer 140080158579432 started
Writer 140080158096104 started
Writer 140080157612776 started
Writer 140080157129448 started
Writer 140080146156264 started
Writer 140080145607400 started
Projection 140080145124072 started
Projection 140080144640744 started
Projection 140080135736040 started
Projection 140080135252712 started
Projection 140080134769384 started
Projection 140080134286056 started
Writer 140080277662440 wrote 250 events
Writer 140080277662440 used 11.067474126816 seconds, avg 22.588713299475 events/second
Writer 140080277179112 wrote 250 events
Writer 140080277179112 used 11.135949850082 seconds, avg 22.449813744281 events/second
Writer 140080278145768 wrote 250 events
Writer 140080278145768 used 11.206387996674 seconds, avg 22.30870464901 events/second
Writer 140080246336232 wrote 250 events
Writer 140080246336232 used 11.194269180298 seconds, avg 22.332855854494 events/second
Writer 140080167934696 wrote 250 events
Writer 140080167934696 used 11.154451847076 seconds, avg 22.412576021432 events/second
Writer 140080245209832 wrote 250 events
Writer 140080245209832 used 11.269148111343 seconds, avg 22.184463060553 events/second
Writer 140080191650536 wrote 250 events
Writer 140080191650536 used 11.234413862228 seconds, avg 22.253052368004 events/second
Writer 140080276695784 wrote 250 events
Writer 140080276695784 used 11.322942972183 seconds, avg 22.079065541014 events/second
Writer 140080225688296 wrote 250 events
Writer 140080225688296 used 11.298419952393 seconds, avg 22.126987760537 events/second
Writer 140080211655400 wrote 250 events
Writer 140080211655400 used 11.27830696106 seconds, avg 22.166447576145 events/second
Writer 140080245852904 wrote 250 events
Writer 140080245852904 used 11.32093000412 seconds, avg 22.08299140698 events/second
Writer 140080224721640 wrote 250 events
Writer 140080224721640 used 11.318430900574 seconds, avg 22.087867319783 events/second
Writer 140080225204968 wrote 250 events
Writer 140080225204968 used 11.33008313179 seconds, avg 22.065151428461 events/second
Writer 140080393738984 wrote 250 events
Writer 140080158579432 wrote 250 events
Writer 140080158579432 used 11.270320892334 seconds, avg 22.182154562258 events/second
Writer 140080393738984 used 11.373320102692 seconds, avg 21.981268243812 events/second
Writer 140080179710696 wrote 250 events
Writer 140080179710696 used 11.334151983261 seconds, avg 22.057230251475 events/second
Writer 140080212298472 wrote 250 events
Writer 140080212298472 used 11.35918211937 seconds, avg 22.008626798377 events/second
Writer 140080236010216 wrote 250 events
Writer 140080236010216 used 11.383836984634 seconds, avg 21.960960995615 events/second
Writer 140080394222312 wrote 250 events
Writer 140080394222312 used 11.417372941971 seconds, avg 21.896455626932 events/second
Writer 140080245369576 wrote 250 events
Writer 140080245369576 used 11.431972980499 seconds, avg 21.868491154279 events/second
Writer 140080191167208 wrote 250 events
Writer 140080191167208 used 11.403707027435 seconds, avg 21.922695786427 events/second
Writer 140080178100968 wrote 250 events
Writer 140080178100968 used 11.394809007645 seconds, avg 21.939814860633 events/second
Writer 140080168901352 wrote 250 events
Writer 140080168901352 used 11.388991832733 seconds, avg 21.951021097537 events/second
Writer 140080190683880 wrote 250 events
Writer 140080190683880 used 11.406974077225 seconds, avg 21.916416948746 events/second
Writer 140080157129448 wrote 250 events
Writer 140080157129448 used 11.377129077911 seconds, avg 21.973909084443 events/second
Writer 140080192133864 wrote 250 events
Writer 140080192133864 used 11.414477109909 seconds, avg 21.90201071786 events/second
Writer 140080158096104 wrote 250 events
Writer 140080158096104 used 11.379875898361 seconds, avg 21.968605126529 events/second
Writer 140080226171624 wrote 250 events
Writer 140080226171624 used 11.447414875031 seconds, avg 21.838991836079 events/second
Writer 140080179227368 wrote 250 events
Writer 140080179227368 used 11.402391910553 seconds, avg 21.925224282865 events/second
Writer 140080212781800 wrote 250 events
Writer 140080212781800 used 11.4321641922 seconds, avg 21.868125387018 events/second
Writer 140080192617192 wrote 250 events
Writer 140080192617192 used 11.417203903198 seconds, avg 21.896779817515 events/second
Writer 140080211815144 wrote 250 events
Writer 140080211815144 used 11.428509950638 seconds, avg 21.87511767324 events/second
Writer 140080146156264 wrote 250 events
Writer 140080146156264 used 11.445692062378 seconds, avg 21.842279054646 events/second
Writer 140080393095912 wrote 250 events
Writer 140080393095912 used 11.552747011185 seconds, avg 21.639874893648 events/second
Writer 140080246819560 wrote 250 events
Writer 140080246819560 used 11.538779020309 seconds, avg 21.666070522711 events/second
Writer 140080213265128 wrote 250 events
Writer 140080213265128 used 11.507372140884 seconds, avg 21.725203368698 events/second
Writer 140080168418024 wrote 250 events
Writer 140080168418024 used 11.471604824066 seconds, avg 21.792940380541 events/second
Writer 140080178744040 wrote 250 events
Writer 140080178744040 used 11.489959001541 seconds, avg 21.758128115728 events/second
Writer 140080224238312 wrote 250 events
Writer 140080224238312 used 11.541048049927 seconds, avg 21.661810861414 events/second
Writer 140080393255656 wrote 250 events
Writer 140080393255656 used 11.589533805847 seconds, avg 21.571186916412 events/second
Writer 140080235526888 wrote 250 events
Writer 140080235526888 used 11.592377901077 seconds, avg 21.565894601898 events/second
Writer 140080366922472 wrote 250 events
Writer 140080366922472 used 11.620793819427 seconds, avg 21.513160278436 events/second
Writer 140080201489128 wrote 250 events
Writer 140080201489128 used 11.563319921494 seconds, avg 21.620088495114 events/second
Writer 140080235043560 wrote 250 events
Writer 140080235043560 used 11.657913923264 seconds, avg 21.444659966233 events/second
Writer 140080202455784 wrote 250 events
Writer 140080202455784 used 11.638337135315 seconds, avg 21.480731920148 events/second
Writer 140080145607400 wrote 250 events
Writer 140080145607400 used 11.61275601387 seconds, avg 21.528050679908 events/second
Writer 140080178260712 wrote 250 events
Writer 140080178260712 used 11.631182193756 seconds, avg 21.493945829015 events/second
Writer 140080201972456 wrote 250 events
Writer 140080201972456 used 11.713427066803 seconds, avg 21.343027840974 events/second
Writer 140080157612776 wrote 250 events
Writer 140080157612776 used 11.674768924713 seconds, avg 21.413700057977 events/second
Writer 140080159062760 wrote 250 events
Writer 140080159062760 used 11.704701185226 seconds, avg 21.358939117177 events/second
Projection 140080134769384 read 2500 events
projection 140080134769384 used 11.804282188416 seconds, avg 211.78754964478 events/second
Projection 140080145124072 read 2500 events
projection 140080145124072 used 11.841995000839 seconds, avg 211.11307679346 events/second
Projection 140080135736040 read 2500 events
projection 140080135736040 used 11.913327932358 seconds, avg 209.84900392188 events/second
Projection 140080144640744 read 2500 events
projection 140080144640744 used 11.974618911743 seconds, avg 208.77491120392 events/second
Projection 140080135252712 read 2500 events
projection 140080135252712 used 11.99015378952 seconds, avg 208.50441486289 events/second
Projection 140080134286056 read 12500 events
projection 140080134286056 used 12.922429084778 seconds, avg 967.31039636538 events/second

done.
postgres avg writes 1058.1729300817 events/second
postgres avg reads 1931.6916746881 events/second

all finished
postgres: destroying event-store tables on database event_store_tests
            Name                         Command              State             Ports         
----------------------------------------------------------------------------------------------
eventstorebenchmarks_mysql_1   docker-entrypoint.sh mysqld    Up       0.0.0.0:32773->3306/tcp
eventstorebenchmarks_php_1     docker-php-entrypoint php -a   Exit 0                          

[32mDocker Info(B[m
Containers: 43
 Running: 1
 Paused: 0
 Stopped: 42
Images: 31
Server Version: 17.09.0-ce
Storage Driver: overlay2
 Backing Filesystem: extfs
 Supports d_type: true
 Native Overlay Diff: true
Logging Driver: json-file
Cgroup Driver: cgroupfs
Plugins:
 Volume: local
 Network: bridge host macvlan null overlay
 Log: awslogs fluentd gcplogs gelf journald json-file logentries splunk syslog
Swarm: inactive
Runtimes: runc
Default Runtime: runc
Init Binary: docker-init
containerd version: 06b9cb35161009dcb7123345749fef02f7cea8e0
runc version: 3f2f8b84a77f73d38244dd690525642a72156c64
init version: 949e6fa
Security Options:
 apparmor
 seccomp
  Profile: default
Kernel Version: 4.10.0-33-generic
Operating System: Ubuntu 17.04
OSType: linux
Architecture: x86_64
CPUs: 8
Total Memory: 31.18GiB
Name: codebook
ID: QODG:6EEM:6T3U:CWGU:KMA6:NNP7:KM72:RYVB:2YGB:BW3E:454Y:EGKH
Docker Root Dir: /var/lib/docker
Debug Mode (client): false
Debug Mode (server): false
Registry: https://index.docker.io/v1/
Experimental: false
Insecure Registries:
 127.0.0.0/8
Live Restore Enabled: false


[32mHardware Info(B[m
Architecture:          x86_64
CPU op-mode(s):        32-bit, 64-bit
Byte Order:            Little Endian
CPU(s):                8
On-line CPU(s) list:   0-7
Thread(s) pro Kern:    2
Kern(e) pro Socket:    4
Socket(s):             1
NUMA-Knoten:           1
Anbieterkennung:       GenuineIntel
Prozessorfamilie:      6
Modell:                158
Model name:            Intel(R) Core(TM) i7-7700HQ CPU @ 2.80GHz
Stepping:              9
CPU MHz:               3624.414
CPU max MHz:           3800,0000
CPU min MHz:           800,0000
BogoMIPS:              5616.00
Virtualisierung:       VT-x
L1d Cache:             32K
L1i Cache:             32K
L2 Cache:              256K
L3 Cache:              6144K
NUMA node0 CPU(s):     0-7
Flags:                 fpu vme de pse tsc msr pae mce cx8 apic sep mtrr pge mca cmov pat pse36 clflush dts acpi mmx fxsr sse sse2 ss ht tm pbe syscall nx pdpe1gb rdtscp lm constant_tsc art arch_perfmon pebs bts rep_good nopl xtopology nonstop_tsc aperfmperf tsc_known_freq pni pclmulqdq dtes64 monitor ds_cpl vmx est tm2 ssse3 sdbg fma cx16 xtpr pdcm pcid sse4_1 sse4_2 x2apic movbe popcnt tsc_deadline_timer aes xsave avx f16c rdrand lahf_lm abm 3dnowprefetch epb intel_pt tpr_shadow vnmi flexpriority ept vpid fsgsbase tsc_adjust bmi1 avx2 smep bmi2 erms invpcid mpx rdseed adx smap clflushopt xsaveopt xsavec xgetbv1 xsaves dtherm ida arat pln pts hwp hwp_notify hwp_act_window hwp_epp
[32mUsing 4 CPUs for each service and 12775 MB memory for database.(B[m
[32mWaiting for mysql database, lean back to enjoy the timer.(B[m
19 18 17 16 15 14 13 12 11 10 9 8 7 6 5 4 3 2 1 0 
[32mStarting benchmark warmup mysql!(B[m
mysql: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using mysql took 11.19425702095 seconds
test 1 using mysql writes 89.331520450931 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using mysql took 2.7192521095276 seconds
test 2 using mysql writes 367.74817476329 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using mysql took 0.85373997688293 seconds
test 3 using mysql writes 2928.292065141 events per second

test 4 load one stream with 2500 events

test 4 using mysql took 0.032384872436523 seconds
test 4 using mysql loads 77196.536898522 events per second

test 5 project 1 stream with 2500 events

test 5 using mysql took 0.16542506217957 seconds
test 5 using mysql loads 15112.583105976 events per second

test 6 project 10 stream with 100 events

test 6 using mysql took 0.19549798965454 seconds
test 6 using mysql loads 5115.1421135689 events per second

test 7 real world test

mysql: destroying event-store tables on database event_store_tests
mysql: set up event store tables on database event_store_tests

starting benchmarks for mysql

Writer 140219045448424 started
Writer 140219044965096 started
Writer 140219044481768 started
Writer 140219044322024 started
Writer 140219019201256 started
Writer 140219018717928 started
Writer 140219018234600 started
Writer 140219018074856 started
Writer 140218928929512 started
Writer 140218928446184 started
Writer 140218927962856 started
Writer 140218927803112 started
Writer 140218891311848 started
Writer 140218890828520 started
Writer 140218890345192 started
Writer 140218881473256 started
Writer 140218880989928 started
Writer 140218880506600 started
Writer 140218880023272 started
Writer 140218879539944 started
Writer 140218868566760 started
Writer 140218868083432 started
Writer 140218867600104 started
Writer 140218867116776 started
Writer 140218866957032 started
Writer 140218857757416 started
Writer 140218857274088 started
Writer 140218856790760 started
Writer 140218847918824 started
Writer 140218847435496 started
Writer 140218846952168 started
Writer 140218846468840 started
Writer 140218845985512 started
Writer 140218835012328 started
Writer 140218834529000 started
Writer 140218834045672 started
Writer 140218833562344 started
Writer 140218833402600 started
Writer 140218824202984 started
Writer 140218823719656 started
Writer 140218823236328 started
Writer 140218814364392 started
Writer 140218813881064 started
Writer 140218813397736 started
Writer 140218812914408 started
Writer 140218812431080 started
Writer 140218801457896 started
Writer 140218800974568 started
Writer 140218800425704 started
Writer 140218799942376 started
Projection 140218791037672 started
Projection 140218790554344 started
Projection 140218790071016 started
Projection 140218789587688 started
Projection 140218789427944 started
Projection 140218780228328 started
Writer 140218890345192 wrote 250 events
Writer 140218890345192 used 167.94023418427 seconds, avg 1.4886248147403 events/second
Writer 140218881473256 wrote 250 events
Writer 140218881473256 used 184.7809419632 seconds, avg 1.3529533800612 events/second
Writer 140218799942376 wrote 250 events
Writer 140218799942376 used 185.29319286346 seconds, avg 1.349213082988 events/second
Writer 140218847435496 wrote 250 events
Writer 140218847435496 used 185.47916984558 seconds, avg 1.3478602487176 events/second
Writer 140218866957032 wrote 250 events
Writer 140218866957032 used 197.67224001884 seconds, avg 1.2647198209327 events/second
Writer 140218834529000 wrote 250 events
Writer 140218834529000 used 200.1063439846 seconds, avg 1.249335703316 events/second
Writer 140219019201256 wrote 250 events
Writer 140219019201256 used 200.828977108 seconds, avg 1.2448402795258 events/second
Writer 140218846468840 wrote 250 events
Writer 140218846468840 used 200.99950814247 seconds, avg 1.2437841381323 events/second
Writer 140218927803112 wrote 250 events
Writer 140218927803112 used 201.12242102623 seconds, avg 1.2430240185275 events/second
Writer 140218845985512 wrote 250 events
Writer 140218845985512 used 201.71775317192 seconds, avg 1.239355466085 events/second
Writer 140218823719656 wrote 250 events
Writer 140218823719656 used 201.71131587029 seconds, avg 1.2393950181792 events/second
Writer 140218823236328 wrote 250 events
Writer 140218823236328 used 201.88418698311 seconds, avg 1.2383337384464 events/second
Writer 140218857757416 wrote 250 events
Writer 140218857757416 used 202.24516105652 seconds, avg 1.2361235180808 events/second
Writer 140218890828520 wrote 250 events
Writer 140218890828520 used 205.64788794518 seconds, avg 1.2156701559058 events/second
Writer 140219018234600 wrote 250 events
Writer 140219018234600 used 205.66854095459 seconds, avg 1.2155480796414 events/second
Writer 140218833562344 wrote 250 events
Writer 140218833562344 used 205.82683706284 seconds, avg 1.2146132329852 events/second
Writer 140218928929512 wrote 250 events
Writer 140218928929512 used 206.30169391632 seconds, avg 1.211817485616 events/second
Writer 140218812431080 wrote 250 events
Writer 140218812431080 used 207.00439405441 seconds, avg 1.2077038322881 events/second
Writer 140218880023272 wrote 250 events
Writer 140218880023272 used 209.06948018074 seconds, avg 1.1957747241916 events/second
Writer 140218812914408 wrote 250 events
Writer 140218812914408 used 209.09900808334 seconds, avg 1.1956058629429 events/second
Writer 140218801457896 wrote 250 events
Writer 140218801457896 used 212.06279110909 seconds, avg 1.1788961122906 events/second
Writer 140218814364392 wrote 250 events
Writer 140218814364392 used 212.82215809822 seconds, avg 1.1746897138625 events/second
Writer 140218800425704 wrote 250 events
Writer 140218800425704 used 215.64365410805 seconds, avg 1.1593199949892 events/second
Writer 140218880989928 wrote 250 events
Writer 140218880989928 used 215.7113058567 seconds, avg 1.1589564070697 events/second
Writer 140219044965096 wrote 250 events
Writer 140219044965096 used 215.7853410244 seconds, avg 1.1585587733308 events/second
Writer 140219018717928 wrote 250 events
Writer 140219018717928 used 216.20305991173 seconds, avg 1.1563203596752 events/second
Writer 140218813881064 wrote 250 events
Writer 140218813881064 used 216.13210821152 seconds, avg 1.1566999557296 events/second
Writer 140218834045672 wrote 250 events
Writer 140218834045672 used 216.85099411011 seconds, avg 1.1528653628079 events/second
Writer 140218867116776 wrote 250 events
Writer 140218867116776 used 217.97738194466 seconds, avg 1.1469079854509 events/second
Writer 140219044481768 wrote 250 events
Writer 140219044481768 used 218.62523913383 seconds, avg 1.1435093266929 events/second
Writer 140218846952168 wrote 250 events
Writer 140218846952168 used 218.56405997276 seconds, avg 1.1438294110713 events/second
Writer 140219018074856 wrote 250 events
Writer 140219018074856 used 218.82111597061 seconds, avg 1.1424857189449 events/second
Writer 140219044322024 wrote 250 events
Writer 140219044322024 used 220.30238819122 seconds, avg 1.1348038577911 events/second
Writer 140218867600104 wrote 250 events
Writer 140218867600104 used 220.44065904617 seconds, avg 1.1340920548946 events/second
Writer 140218813397736 wrote 250 events
Writer 140218813397736 used 220.394343853 seconds, avg 1.1343303808502 events/second
Writer 140218868083432 wrote 250 events
Writer 140218868083432 used 220.84011793137 seconds, avg 1.1320406923424 events/second
Writer 140218928446184 wrote 250 events
Writer 140218928446184 used 221.3782980442 seconds, avg 1.129288652992 events/second
Writer 140218857274088 wrote 250 events
Writer 140218857274088 used 221.35009407997 seconds, avg 1.1294325445811 events/second
Writer 140218856790760 wrote 250 events
Writer 140218856790760 used 222.03433203697 seconds, avg 1.1259519989835 events/second
Writer 140218833402600 wrote 250 events
Writer 140218833402600 used 222.01264214516 seconds, avg 1.126062000724 events/second
Writer 140218824202984 wrote 250 events
Writer 140218824202984 used 222.01138710976 seconds, avg 1.126068366378 events/second
Writer 140218868566760 wrote 250 events
Writer 140218868566760 used 222.08421897888 seconds, avg 1.1256990755555 events/second
Writer 140218879539944 wrote 250 events
Writer 140218879539944 used 223.07332086563 seconds, avg 1.1207077521861 events/second
Writer 140218880506600 wrote 250 events
Writer 140218880506600 used 223.1212310791 seconds, avg 1.1204671056667 events/second
Writer 140218847918824 wrote 250 events
Writer 140218847918824 used 223.59097290039 seconds, avg 1.1181131185979 events/second
Writer 140219045448424 wrote 250 events
Writer 140219045448424 used 224.1256570816 seconds, avg 1.1154456979862 events/second
Writer 140218927962856 wrote 250 events
Writer 140218927962856 used 224.13103795052 seconds, avg 1.1154189187095 events/second
Writer 140218800974568 wrote 250 events
Writer 140218800974568 used 224.37527894974 seconds, avg 1.1142047429209 events/second
Writer 140218891311848 wrote 250 events
Writer 140218891311848 used 224.47623181343 seconds, avg 1.1137036557518 events/second
Writer 140218835012328 wrote 250 events
Writer 140218835012328 used 224.93272399902 seconds, avg 1.1114434376435 events/second
Projection 140218789587688 read 2500 events
projection 140218789587688 used 225.33201789856 seconds, avg 11.094739324287 events/second
Projection 140218791037672 read 2500 events
projection 140218791037672 used 225.36525607109 seconds, avg 11.093103007907 events/second
Projection 140218790071016 read 2500 events
projection 140218790071016 used 225.40448594093 seconds, avg 11.091172340976 events/second
Projection 140218790554344 read 2500 events
projection 140218790554344 used 225.43425011635 seconds, avg 11.089707968996 events/second
Projection 140218789427944 read 2500 events
projection 140218789427944 used 225.46193790436 seconds, avg 11.08834610062 events/second
Projection 140218780228328 read 12500 events
projection 140218780228328 used 228.80626606941 seconds, avg 54.631370961702 events/second

done.
mysql avg writes 55.551983921661 events/second
mysql avg reads 109.25599814649 events/second

all finished
mysql: destroying event-store tables on database event_store_tests

[32mStarting benchmark mysql!(B[m
mysql: set up event store tables on database event_store_tests

test 1 create 10 streams with 100 events in each stream, using 1 event per commit

test 1 using mysql took 11.367032051086 seconds
test 1 using mysql writes 87.973711651884 events per second

test 2 create 10 streams with 100 events in each stream, using 5 events per commit

test 2 using mysql took 2.6759769916534 seconds
test 2 using mysql writes 373.69529077383 events per second

test 3 create one stream with 2500 events using a single commit

test 3 using mysql took 0.88110089302063 seconds
test 3 using mysql writes 2837.3595121773 events per second

test 4 load one stream with 2500 events

test 4 using mysql took 0.02056884765625 seconds
test 4 using mysql loads 121543.02670623 events per second

test 5 project 1 stream with 2500 events

test 5 using mysql took 0.17989277839661 seconds
test 5 using mysql loads 13897.167091879 events per second

test 6 project 10 stream with 100 events

test 6 using mysql took 0.22162485122681 seconds
test 6 using mysql loads 4512.1293684553 events per second

test 7 real world test

mysql: destroying event-store tables on database event_store_tests
mysql: set up event store tables on database event_store_tests

starting benchmarks for mysql

Writer 140116062595816 started
Writer 140116062112488 started
Writer 140116061629160 started
Writer 140116061469416 started
Writer 140116036348648 started
Writer 140116035865320 started
Writer 140116035381992 started
Writer 140116035222248 started
Writer 140115946117864 started
Writer 140115945634536 started
Writer 140115945151208 started
Writer 140115908954856 started
Writer 140115908471528 started
Writer 140115907988200 started
Writer 140115907504872 started
Writer 140115907345128 started
Writer 140115898145512 started
Writer 140115897662184 started
Writer 140115897178856 started
Writer 140115888306920 started
Writer 140115887823592 started
Writer 140115887340264 started
Writer 140115886856936 started
Writer 140115886373608 started
Writer 140115875400424 started
Writer 140115874917096 started
Writer 140115874433768 started
Writer 140115873950440 started
Writer 140115873790696 started
Writer 140115864591080 started
Writer 140115864107752 started
Writer 140115863624424 started
Writer 140115854752488 started
Writer 140115854269160 started
Writer 140115853785832 started
Writer 140115853302504 started
Writer 140115852819176 started
Writer 140115841845992 started
Writer 140115841362664 started
Writer 140115840879336 started
Writer 140115840396008 started
Writer 140115840236264 started
Writer 140115831036648 started
Writer 140115830553320 started
Writer 140115830069992 started
Writer 140115821198056 started
Writer 140115820714728 started
Writer 140115820231400 started
Writer 140115819682536 started
Writer 140115819199208 started
Projection 140115808226024 started
Projection 140115807742696 started
Projection 140115807259368 started
Projection 140115806776040 started
Projection 140115806616296 started
Projection 140115797416680 started
Writer 140115840396008 wrote 250 events
Writer 140115840396008 used 188.57556295395 seconds, avg 1.3257285094838 events/second
Writer 140115873950440 wrote 250 events
Writer 140115873950440 used 192.57310700417 seconds, avg 1.2982082695202 events/second
Writer 140115874433768 wrote 250 events
Writer 140115874433768 used 198.02741098404 seconds, avg 1.2624514897089 events/second
Writer 140115875400424 wrote 250 events
Writer 140115875400424 used 200.20484304428 seconds, avg 1.2487210409026 events/second
Writer 140115831036648 wrote 250 events
Writer 140115831036648 used 200.16839790344 seconds, avg 1.2489483985409 events/second
Writer 140115907988200 wrote 250 events
Writer 140115907988200 used 200.22787284851 seconds, avg 1.2485774155387 events/second
Writer 140115830553320 wrote 250 events
Writer 140115830553320 used 203.10648798943 seconds, avg 1.2308814084413 events/second
Writer 140116062595816 wrote 250 events
Writer 140116062595816 used 203.43250107765 seconds, avg 1.2289088453205 events/second
Writer 140115820231400 wrote 250 events
Writer 140115820231400 used 203.33944511414 seconds, avg 1.2294712413505 events/second
Writer 140115888306920 wrote 250 events
Writer 140115888306920 used 203.396889925 seconds, avg 1.2291240052499 events/second
Writer 140115819199208 wrote 250 events
Writer 140115819199208 used 205.75728607178 seconds, avg 1.215023801941 events/second
Writer 140116035222248 wrote 250 events
Writer 140116035222248 used 206.66738986969 seconds, avg 1.2096731862614 events/second
Writer 140115853302504 wrote 250 events
Writer 140115853302504 used 207.59305715561 seconds, avg 1.2042791961612 events/second
Writer 140115907504872 wrote 250 events
Writer 140115907504872 used 207.79081392288 seconds, avg 1.203133070612 events/second
Writer 140115854269160 wrote 250 events
Writer 140115854269160 used 207.80044698715 seconds, avg 1.2030772966309 events/second
Writer 140115897662184 wrote 250 events
Writer 140115897662184 used 207.83629989624 seconds, avg 1.2028697591557 events/second
Writer 140115840879336 wrote 250 events
Writer 140115840879336 used 208.10879707336 seconds, avg 1.2012947242776 events/second
Writer 140115946117864 wrote 250 events
Writer 140115946117864 used 210.39807391167 seconds, avg 1.1882238052472 events/second
Writer 140116061629160 wrote 250 events
Writer 140116061629160 used 212.16446089745 seconds, avg 1.1783311820581 events/second
Writer 140116062112488 wrote 250 events
Writer 140116062112488 used 213.77504110336 seconds, avg 1.1694536401896 events/second
Writer 140116036348648 wrote 250 events
Writer 140116036348648 used 213.80253791809 seconds, avg 1.1693032385601 events/second
Writer 140115864591080 wrote 250 events
Writer 140115864591080 used 214.09492111206 seconds, avg 1.1677063552066 events/second
Writer 140115945634536 wrote 250 events
Writer 140115874917096 wrote 250 events
Writer 140115874917096 used 214.37808799744 seconds, avg 1.1661639598306 events/second
Writer 140115945634536 used 214.41008090973 seconds, avg 1.1659899522414 events/second
Writer 140115841845992 wrote 250 events
Writer 140115841845992 used 214.39544987679 seconds, avg 1.1660695231344 events/second
Writer 140115820714728 wrote 250 events
Writer 140115820714728 used 214.48045492172 seconds, avg 1.1656073747663 events/second
Writer 140115907345128 wrote 250 events
Writer 140115907345128 used 214.61919379234 seconds, avg 1.1648538771508 events/second
Writer 140115854752488 wrote 250 events
Writer 140115854752488 used 214.78990101814 seconds, avg 1.1639280935228 events/second
Writer 140115840236264 wrote 250 events
Writer 140115840236264 used 214.77263998985 seconds, avg 1.1640216370754 events/second
Writer 140115945151208 wrote 250 events
Writer 140115945151208 used 216.23315906525 seconds, avg 1.1561594025668 events/second
Writer 140115821198056 wrote 250 events
Writer 140115821198056 used 216.16385602951 seconds, avg 1.1565300721036 events/second
Writer 140115908954856 wrote 250 events
Writer 140115830069992 wrote 250 events
Writer 140115830069992 used 218.00137591362 seconds, avg 1.1467817528778 events/second
Writer 140115908954856 used 218.06795501709 seconds, avg 1.1464316248594 events/second
Writer 140115819682536 wrote 250 events
Writer 140115819682536 used 217.99517416954 seconds, avg 1.1468143776686 events/second
Writer 140115853785832 wrote 250 events
Writer 140115853785832 used 218.07510113716 seconds, avg 1.1463940573516 events/second
Writer 140115887823592 wrote 250 events
Writer 140115887823592 used 218.13241386414 seconds, avg 1.1460928505367 events/second
Writer 140115841362664 wrote 250 events
Writer 140115841362664 used 218.50361704826 seconds, avg 1.1441458195394 events/second
Writer 140115887340264 wrote 250 events
Writer 140115887340264 used 219.75721383095 seconds, avg 1.1376190826314 events/second
Writer 140115863624424 wrote 250 events
Writer 140115863624424 used 220.13679599762 seconds, avg 1.135657484552 events/second
Writer 140115873790696 wrote 250 events
Writer 140115873790696 used 220.69259810448 seconds, avg 1.1327973939645 events/second
Writer 140115864107752 wrote 250 events
Writer 140115864107752 used 220.72499203682 seconds, avg 1.1326311429124 events/second
Writer 140115886856936 wrote 250 events
Writer 140115886856936 used 221.62953305244 seconds, avg 1.1280085129306 events/second
Writer 140116061469416 wrote 250 events
Writer 140116061469416 used 222.44834494591 seconds, avg 1.1238564173664 events/second
Writer 140116035381992 wrote 250 events
Writer 140116035381992 used 222.5917699337 seconds, avg 1.1231322706786 events/second
Writer 140115852819176 wrote 250 events
Writer 140115852819176 used 222.57438993454 seconds, avg 1.1232199718644 events/second
Writer 140115898145512 wrote 250 events
Writer 140115898145512 used 222.61576986313 seconds, avg 1.1230111871846 events/second
Writer 140115897178856 wrote 250 events
Writer 140115897178856 used 223.08666396141 seconds, avg 1.1206407212367 events/second
Writer 140115908471528 wrote 250 events
Writer 140115908471528 used 224.39817500114 seconds, avg 1.1140910571074 events/second
Writer 140115886373608 wrote 250 events
Writer 140115886373608 used 224.60945081711 seconds, avg 1.1130431025521 events/second
Writer 140116035865320 wrote 250 events
Writer 140116035865320 used 224.67358398438 seconds, avg 1.1127253839392 events/second
Projection 140115806616296 read 2500 events
projection 140115806616296 used 225.3844769001 seconds, avg 11.092156986074 events/second
Projection 140115808226024 read 2500 events
projection 140115808226024 used 225.43510103226 seconds, avg 11.089666110347 events/second
Projection 140115807742696 read 2500 events
projection 140115807742696 used 225.4952788353 seconds, avg 11.086706617153 events/second
Projection 140115806776040 read 2500 events
projection 140115806776040 used 225.49978804588 seconds, avg 11.086484921624 events/second
Projection 140115807259368 read 2500 events
projection 140115807259368 used 225.5105099678 seconds, avg 11.085957813483 events/second
Projection 140115797416680 read 12500 events
projection 140115797416680 used 230.96055102348 seconds, avg 54.121796751035 events/second

done.
mysql avg writes 55.632074133474 events/second
mysql avg reads 108.23722475807 events/second

all finished
mysql: destroying event-store tables on database event_store_tests
