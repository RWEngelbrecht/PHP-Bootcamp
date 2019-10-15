SELECT genre.id_genre AS 'id_genfre',
		genre.name as 'name_genre',
		distrib.id_distrib as 'id_distrib',
		distrib.name as 'name_distrib',
		film.title as 'title_film' FROM film
LEFT JOIN genre ON film.id_genre = genre.id_genre
LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib
WHERE film.id_genre >= 4 AND film.id_genre <= 8;
