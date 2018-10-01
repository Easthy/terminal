SELECT
	city_activity_category.id,
	city_activity_category.name,
	city_activity_category.icon_path
FROM
	public.city_activity_category
WHERE
	city_activity_category.state=0
ORDER BY
	city_activity_category.name
;