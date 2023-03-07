ceph config set mon mon_warn_on_insecure_global_id_reclaim false
ceph config set mon mon_warn_on_insecure_global_id_reclaim_allowed false
ceph config set mon mon_warn_on_insecure_global_id_reclaim true
ceph config set mon mon_warn_on_insecure_global_id_reclaim_allowed true
ceph config set mon auth_allow_insecure_global_id_reclaim fals

IMPORTANT: Do NOT enable / allow insecure_global_id_reclaim until it is sure that ALL clients have been patched to the latest version, this includes kernel clients via the "ceph-common" package.