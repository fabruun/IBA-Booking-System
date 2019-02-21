select
rekvirents.rekvirentid AS Brugernavn,
users.name AS Navn,
users.email AS Email
from rekvirents
join users on
users.uid = rekvirents.rekvirentid;
