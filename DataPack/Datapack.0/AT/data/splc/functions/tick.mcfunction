xp add @a[level=..49] 1 points
execute as @e[tag=c2] at @s run tp @s ~ ~ ~ ~1 ~
execute as @e[tag=c1] at @s run tp @s ~ ~ ~ ~-.3 ~
execute at @e[tag=c1] run function splc:sci1
execute at @e[tag=c2] run function splc:stbi
execute as @e[tag=c1] at @s run playsound entity.lightning_bolt.thunder master @p

execute as @e[tag=a2] at @s run tp @s ~ ~ ~ ~1 ~
execute as @e[tag=a1] at @s run tp @s ~ ~ ~ ~-.3 ~
execute at @e[tag=a1] run function splc:sci2
execute at @e[tag=a2] run function splc:abri