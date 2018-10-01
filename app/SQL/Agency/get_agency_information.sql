SELECT
	agency.id,
	agency.shortname,
	agency.fullname,
	agency.shortname,
	agency.phone,
	agency.address,
	agency.email,
	agency.www,
	agency.inn,
	agency.timetable,
	agency.address_comment,
	agency.coords,
	agency.okato,
	agency.description,
	cd.shortname as district_name,
	cr.name as region_name
FROM
	public.agency
LEFT JOIN public.city_district cd
ON cd.id=agency.district_id
LEFT JOIN public.city_region cr
ON cr.id=agency.region_id
WHERE
	agency.id = any(:agency_id)