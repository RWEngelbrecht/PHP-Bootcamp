SELECT last_name, first_name, DATE(birthdate) AS birthdate FROM db_rengelbr.user_card WHERE YEAR(birthdate) IN (1989)
ORDER BY last_name ASC;
