SELECT
	agency_photo_album.id 			as photo_album_id,
	agency_photo_album.agency_id,
	agency_photo_album.name 		as album_name,
	agency_photo_album.description 	as album_description,
	agency_photo.path,
	counter.photo_count
FROM
	public.agency_photo_album

LEFT JOIN public.agency_photo
ON agency_photo.photo_album_id = agency_photo_album.id
AND agency_photo.state = 0

LEFT JOIN (
	SELECT
		COUNT(agency_photo.id) as photo_count,
		agency_photo.photo_album_id
	FROM
		public.agency_photo
	GROUP BY
		agency_photo.photo_album_id
) counter
ON counter.photo_album_id = agency_photo.photo_album_id

WHERE
	agency_photo_album.agency_id = ANY(:agency_id)
AND agency_photo_album.state = 0
