SELECT
	service.id,
	service.code,
	service.name,
	service.price,
	service.price_hour,
	service.category_id,
	service_category.image_path as category_image,
	service_category.icon_path as icon_image
FROM
	public.service
INNER JOIN public.service_to_agency
ON service_to_agency.service_id=service.id
LEFT JOIN LATERAL(
    SELECT 
    	service_tree.ancestor
    FROM 
    	public.service_tree
    WHERE 
    	service_tree.descendant = service.category_id 
    AND service_tree.length > 0
) root_category
ON true
LEFT JOIN public.service_category
ON service_category.id=root_category.ancestor
WHERE
	service_to_agency.agency_id=:agency_id
AND service.state=0
AND service_category.state=0
AND service_to_agency.state=0
ORDER BY
	service.name
;
