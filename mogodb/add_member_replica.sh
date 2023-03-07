rs.initiate()
var cfg = rs.conf()
cfg.members[0].host="mongodb-replica-0.mongo.mongodb:27017"
rs.reconfig(cfg)
rs.add("mongodb-replica-1.mongo.mongodb:27017")
rs.status()