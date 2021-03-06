-- One-time activities
SELECT
    a.id,
    to_char(a.start_date, 'DD') as date,
    to_char(a.start_date, 'MM') as month,
    a.start_date,
    a.name,
    a.schedule as activity_schedule,
    a.periodicity_id,
    a.category_id,
    ac.image_path as category_image,
    ac.icon_path as category_icon,
    ag.shortname as ag_shortname
FROM
    public.activity a
LEFT JOIN public.activity_category ac
ON ac.id=a.category_id

INNER JOIN public.agency ag
ON a.agency_id = ag.id

WHERE
    a.state = 0
AND a.execution_state = 0
AND a.periodicity_id = 1 /* One-time activity */
AND a.start_date BETWEEN CURRENT_DATE AND (CURRENT_DATE + 3)

UNION ALL

/* Periodical activities */
SELECT
    a.id,
    '' as date,
    '' as month,
    a.start_date,
    a.name,
    a.schedule as activity_schedule,
    a.periodicity_id,
    a.category_id,
    ac.image_path as category_image,
    ac.icon_path as category_icon,
    ag.shortname as ag_shortname
FROM
    public.activity a
LEFT JOIN public.activity_category ac
ON ac.id=a.category_id

INNER JOIN public.agency ag
ON a.agency_id = ag.id

WHERE
    a.state = 0
AND a.execution_state = 0
AND a.periodicity_id = 2 /* Periodical activity */
AND CURRENT_DATE BETWEEN a.start_date AND a.end_date

ORDER BY
    4
LIMIT 
    :limit
;