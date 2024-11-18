execute as @p[level=10..,y_rotation=158..-159] run setblock ~ ~ ~-4 water keep
execute as @p[level=10..,y_rotation=158..-159] run tellraw @s {"text":"Nord","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-159..-114] run setblock ~3 ~ ~-3 water keep
execute as @p[level=10..,y_rotation=-159..-114] run tellraw @s {"text":"Nord-Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~ ~ water keep
execute as @p[level=10..,y_rotation=-114..-69] run tellraw @s {"text":"Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-69..-24] run setblock ~3 ~ ~3 water keep
execute as @p[level=10..,y_rotation=-69..-24] run tellraw @s {"text":"Sud-Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-24..23] run setblock ~ ~ ~4 water keep
execute as @p[level=10..,y_rotation=-24..23] run tellraw @s {"text":"Sud","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=23..68] run setblock ~-3 ~ ~3 water keep
execute as @p[level=10..,y_rotation=23..68] run tellraw @s {"text":"Sud-Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~ ~ water keep
execute as @p[level=10..,y_rotation=68..113] run tellraw @s {"text":"Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=113..158] run setblock ~-3 ~ ~-3 water keep
execute as @p[level=10..,y_rotation=113..158] run tellraw @s {"text":"Nord-Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}
xp add @p -10 levels