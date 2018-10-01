SELECT
	agency.id
FROM
	public.agency
WHERE
	agency.headagency_id=:agency_id
;
