DELETE FROM jos_opensocial_profiles WHERE socialengine_actor_id NOT IN (SELECT id FROM jos_anahita_nodes WHERE type LIKE '%person%');