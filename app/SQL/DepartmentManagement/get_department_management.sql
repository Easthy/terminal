SELECT
	department_management.agency_id,
	department_management.surname,
	department_management.firstname,
	department_management.fathername,
	department_management.post,
	department_management.phone,
    department_management.path
FROM
	public.department_management
WHERE
	department_management.state=0
ORDER BY
    id
;