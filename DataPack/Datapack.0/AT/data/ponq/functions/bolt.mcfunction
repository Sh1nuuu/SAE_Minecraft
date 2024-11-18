execute as @p[level=10..,y_rotation=158..-159] run summon minecraft:lightning_bolt ~ ~ ~-4
execute as @p[level=10..,y_rotation=158..-159] run tellraw @s {"text":"Nord","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-159..-114] run summon minecraft:lightning_bolt ~3 ~ ~-3
execute as @p[level=10..,y_rotation=-159..-114] run tellraw @s {"text":"Nord-Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-114..-69] run summon minecraft:lightning_bolt ~4 ~ ~
execute as @p[level=10..,y_rotation=-114..-69] run tellraw @s {"text":"Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-69..-24] run summon minecraft:lightning_bolt ~3 ~ ~3
execute as @p[level=10..,y_rotation=-69..-24] run tellraw @s {"text":"Sud-Est","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=-24..23] run summon minecraft:lightning_bolt ~ ~ ~4
execute as @p[level=10..,y_rotation=-24..23] run tellraw @s {"text":"Sud","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=23..68] run summon minecraft:lightning_bolt ~-3 ~ ~3
execute as @p[level=10..,y_rotation=23..68] run tellraw @s {"text":"Sud-Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=68..113] run summon minecraft:lightning_bolt ~-4 ~ ~
execute as @p[level=10..,y_rotation=68..113] run tellraw @s {"text":"Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}

execute as @p[level=10..,y_rotation=113..158] run summon minecraft:lightning_bolt ~-3 ~ ~-3
execute as @p[level=10..,y_rotation=113..158] run tellraw @s {"text":"Nord-Ouest","color":"light_purple","hoverEvent":{"action":"show_text","value":[{"text":"","bold":true}]}}
xp add @p -10 levels