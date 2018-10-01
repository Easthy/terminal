SELECT
	agency_photo.*,
	agency_photo_album.name 		as album_name
FROM
	public.agency_photo
INNER JOIN public.agency_photo_album
ON agency_photo_album.id = agency_photo.photo_album_id

WHERE
	agency_photo.photo_album_id = :photo_album_id
AND agency_photo.state = 0
