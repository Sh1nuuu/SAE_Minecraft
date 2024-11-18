execute as @p run summon armor_stand ~ ~ ~ {Invisible:1b,Tags:["a1"]}
execute as @p run summon armor_stand ~ ~ ~ {Invisible:1b,Tags:["a2"]}
effect give @p slowness 10 100 true
effect give @p slow_falling 10 100 true
effect give @a mining_fatigue 30 100 true

execute at @e[tag=a1] run function splc:sci2
execute at @e[tag=a2] run function splc:abri
title @p title [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true},{"text":"Protection Divinie","color":"gray","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"underlined":false,"obfuscated":true}]

schedule function splc:abrition 1s