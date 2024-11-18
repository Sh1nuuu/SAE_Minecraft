execute as @p run summon armor_stand ~ ~ ~ {Invisible:1b,Tags:["c1"]}
execute as @p run summon armor_stand ~ ~ ~ {Invisible:1b,Tags:["c2"]}
effect give @p slowness 10 100 true

execute at @e[tag=c1] run function splc:sci1
execute at @e[tag=c2] run function splc:stbi
title @a title [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]
tellraw @p [{"text":"aaa","color":"aqua","bold":true,"obfuscated":true},{"text":"La Colère de Zeus","color":"yellow","bold":true,"underlined":true,"obfuscated":false},{"text":"aaa","color":"aqua","bold":true,"obfuscated":true}]

schedule function splc:thundering 3s