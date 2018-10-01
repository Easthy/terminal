SELECT
	p.*
FROM
	public.city_activity_photo p
WHERE
	p.activity_id=:activity_id
AND p.state=0