execute as @p[level=10..,y_rotation=158..-159] run setblock ~ ~ ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run setblock ~ ~1 ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run setblock ~1 ~ ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run setblock ~1 ~1 ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run setblock ~-1 ~ ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run setblock ~-1 ~1 ~-4 tinted_glass keep
execute as @p[level=10..,y_rotation=158..-159] run tellraw @s {"text":"Nord","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}


execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~ ~ tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~1 ~ tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~ ~1 tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~1 ~1 tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~ ~-1 tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run setblock ~4 ~1 ~-1 tinted_glass keep
execute as @p[level=10..,y_rotation=-114..-69] run tellraw @s {"text":"Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}


execute as @p[level=10..,y_rotation=-24..23] run setblock ~ ~ ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run setblock ~ ~1 ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run setblock ~1 ~ ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run setblock ~1 ~1 ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run setblock ~-1 ~ ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run setblock ~-1 ~1 ~4 tinted_glass keep
execute as @p[level=10..,y_rotation=-24..23] run tellraw @s {"text":"Sud","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}


execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~ ~ tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~1 ~ tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~ ~-1 tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~1 ~-1 tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~ ~1 tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run setblock ~-4 ~1 ~1 tinted_glass keep
execute as @p[level=10..,y_rotation=68..113] run tellraw @s {"text":"Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}
xp add @p -10 levels
