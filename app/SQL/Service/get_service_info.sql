SELECT
	service.id,
	service.code,
	service.name,
	service.price,
	service.price_hour,
	service.time,
	service.description,
	service.result,
	service.client_resources,
	service.agency_resources,
	service.location_type_id,
	service_location_type.text as service_location_type,
	service_chargeable_type.chargeable_type,
	service_chargeable_type.chargeable_type_factor,
	service.category_id,
	service_category.text as category_name,
	service_category.image_path as category_image,
	service_category.icon_path as icon_image
FROM
	public.service
LEFT JOIN public.service_location_type
ON service_location_type.id=service.location_type_id
LEFT JOIN (
	SELECT
		json_agg(service_chargeable_type.text) as chargeable_type,
		json_agg(service_chargeable_type_to_service.factor) as chargeable_type_factor
	FROM
		public.service_chargeable_type_to_service
	INNER JOIN public.service_chargeable_type
	ON service_chargeable_type.id=service_chargeable_type_to_service.chargeable_type_id
	WHERE
		service_chargeable_type_to_service.service_id=:service_id
) service_chargeable_type 
ON true
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
	service.id=:service_id