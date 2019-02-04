SELECT
    id,
    date,
    month,
    start_date,
    name,
    activity_schedule,
    periodicity_id,
    category_id,
    category_image,
    category_icon,
    ag_shortname
FROM
    public.coming_activity
WHERE
    start_date BETWEEN CURRENT_DATE AND (CURRENT_DATE + 14)

ORDER BY
    4
LIMIT 
    :limit
;