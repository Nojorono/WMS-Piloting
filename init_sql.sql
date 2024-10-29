SELECT count(TIMESTAMPDIFF(DAY, gr_datetime, NOW())) AS aging
FROM t_wh_location_inventory
WHERE client_project_id= '' #based on login
AND TIMESTAMPDIFF(DAY, gr_datetime, NOW()) < 60