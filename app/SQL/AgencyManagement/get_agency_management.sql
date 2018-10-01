SELECT
	agency_management.agency_id,
	agency_management.surname,
	agency_management.firstname,
	agency_management.fathername,
	agency_management.post,
	agency_management.phone
FROM
	public.agency_management
WHERE
	agency_management.agency_id=any(:agency_id)
and agency_management.state=0
;