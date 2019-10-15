SELECT title as Title, summary as Summary, prod_year FROM db_rengelbr.film INNER JOIN db_rengelbr.genre ON film.id_genre = genre.id_genre AND genre.name = 'erotic'
ORDER BY prod_year DESC;
