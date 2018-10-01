SELECT
	service_category.id,
	service_category.text,
	service_category.image_path
FROM
	public.service_category

WHERE
	service_category.state=0
AND service_category.id IN (
	select
		ancestor
	from
		service_tree st1
	where
		st1.length = 0
		and not exists ( 
			select 
				1 
			from 
				service_tree st2 
			where 
				st2.descendant=st1.ancestor 
			and st2.length>0 
		)
)
ORDER BY
	service_category.text
