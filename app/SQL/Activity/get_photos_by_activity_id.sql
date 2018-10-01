SELECT
	p.*
FROM
	public.activity_photo p
WHERE
	p.activity_id=:activity_id
AND p.state=0