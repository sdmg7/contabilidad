<?php

/*
 * **************************
 * *** RTF Class Code PHP ***
 * --------------------------
 * ** Based on a design found in phpclasses.org - By Michele Brodoloni (michele@xtnet.it)
 * ** RTF Generation Class (http://www.phpclasses.org/browse/package/3560.html)
 *
 * Fixes and implementations:
 * ---------------------------
 * 1. Small fixes
 * 2. Implementation of tables
 * 3. Setting the margins
 *
 * ******************************************************************
 * *** Author: Maury Miranda Marques - maurymmarques@gmail.com.br ***
 * *** Modify By: Marco Jarrin Lopez - marcojarrin@msn.com        ***
 * ******************************************************************
 */

$MSWORDFOOTER='{\*\themedata 504b030414000600080000002100828abc13fa0000001c020000130000005b436f6e74656e745f54797065735d2e786d6cac91cb6ac3301045f785fe83d0b6d8
72ba28a5d8cea249777d2cd20f18e4b12d6a8f843409c9df77ecb850ba082d74231062ce997b55ae8fe3a00e1893f354e9555e6885647de3a8abf4fbee29bbd7
2a3150038327acf409935ed7d757e5ee14302999a654e99e393c18936c8f23a4dc072479697d1c81e51a3b13c07e4087e6b628ee8cf5c4489cf1c4d075f92a0b
44d7a07a83c82f308ac7b0a0f0fbf90c2480980b58abc733615aa2d210c2e02cb04430076a7ee833dfb6ce62e3ed7e14693e8317d8cd0433bf5c60f53fea2fe7
065bd80facb647e9e25c7fc421fd2ddb526b2e9373fed4bb902e182e97b7b461e6bfad3f010000ffff0300504b030414000600080000002100a5d6a7e7c00000
00360100000b0000005f72656c732f2e72656c73848fcf6ac3300c87ef85bd83d17d51d2c31825762fa590432fa37d00e1287f68221bdb1bebdb4fc7060abb08
84a4eff7a93dfeae8bf9e194e720169aaa06c3e2433fcb68e1763dbf7f82c985a4a725085b787086a37bdbb55fbc50d1a33ccd311ba548b63095120f88d94fbc
52ae4264d1c910d24a45db3462247fa791715fd71f989e19e0364cd3f51652d73760ae8fa8c9ffb3c330cc9e4fc17faf2ce545046e37944c69e462a1a82fe353
bd90a865aad41ed0b5b8f9d6fd010000ffff0300504b0304140006000800000021006b799616830000008a0000001c0000007468656d652f7468656d652f7468
656d654d616e616765722e786d6c0ccc4d0ac3201040e17da17790d93763bb284562b2cbaebbf600439c1a41c7a0d29fdbd7e5e38337cedf14d59b4b0d592c9c
070d8a65cd2e88b7f07c2ca71ba8da481cc52c6ce1c715e6e97818c9b48d13df49c873517d23d59085adb5dd20d6b52bd521ef2cdd5eb9246a3d8b4757e8d3f7
29e245eb2b260a0238fd010000ffff0300504b03041400060008000000210096b5ade296060000501b0000160000007468656d652f7468656d652f7468656d65
312e786d6cec594f6fdb3614bf0fd87720746f6327761a07758ad8b19b2d4d1bc46e871e698996d850a240d2497d1bdae38001c3ba618715d86d87615b8116d8
a5fb34d93a6c1dd0afb0475292c5585e9236d88aad3e2412f9e3fbff1e1fa9abd7eec70c1d1221294fda5efd72cd4324f1794093b0eddd1ef62fad79482a9c04
98f184b4bd2991deb58df7dfbb8ad755446282607d22d771db8b944ad79796a40fc3585ee62949606ecc458c15bc8a702910f808e8c66c69b9565b5d8a314d3c
94e018c8de1a8fa94fd05093f43672e23d06af89927ac06762a049136785c10607758d9053d965021d62d6f6804fc08f86e4bef210c352c144dbab999fb7b471
7509af678b985ab0b6b4ae6f7ed9ba6c4170b06c788a705430adf71bad2b5b057d03606a1ed7ebf5babd7a41cf00b0ef83a6569632cd467faddec9699640f671
9e76b7d6ac355c7c89feca9cccad4ea7d36c65b258a206641f1b73f8b5da6a6373d9c11b90c537e7f08dce66b7bbeae00dc8e257e7f0fd2badd5868b37a088d1
e4600ead1ddaef67d40bc898b3ed4af81ac0d76a197c86826828a24bb318f3442d8ab518dfe3a20f000d6458d104a9694ac6d88728eee2782428d60cf03ac1a5
193be4cbb921cd0b495fd054b5bd0f530c1931a3f7eaf9f7af9e3f45c70f9e1d3ff8e9f8e1c3e3073f5a42ceaa6d9c84e5552fbffdeccfc71fa33f9e7ef3f2d1
17d57859c6fffac327bffcfc793510d26726ce8b2f9ffcf6ecc98baf3efdfdbb4715f04d814765f890c644a29be408edf3181433567125272371be15c308d3f2
8acd249438c19a4b05fd9e8a1cf4cd296699771c393ac4b5e01d01e5a30a787d72cf1178108989a2159c77a2d801ee72ce3a5c545a6147f32a99793849c26ae6
6252c6ed637c58c5bb8b13c7bfbd490a75330f4b47f16e441c31f7184e140e494214d273fc80900aedee52ead87597fa824b3e56e82e451d4c2b4d32a423279a
668bb6690c7e9956e90cfe766cb37b077538abd27a8b1cba48c80acc2a841f12e698f13a9e281c57911ce298950d7e03aba84ac8c154f8655c4f2af074481847
bd804859b5e696007d4b4edfc150b12addbecba6b18b148a1e54d1bc81392f23b7f84137c2715a851dd0242a633f900710a218ed715505dfe56e86e877f0034e
16bafb0e258ebb4faf06b769e888340b103d3311da9750aa9d0a1cd3e4efca31a3508f6d0c5c5c398602f8e2ebc71591f5b616e24dd893aa3261fb44f95d843b
5974bb5c04f4edafb95b7892ec1108f3f98de75dc97d5772bdff7cc95d94cf672db4b3da0a6557f70db629362d72bcb0431e53c6066acac80d699a6409fb44d0
8741bdce9c0e4971624a2378cceaba830b05366b90e0ea23aaa241845368b0eb9e2612ca8c742851ca251ceccc70256d8d87265dd96361531f186c3d9058edf2
c00eafe8e1fc5c509031bb4d680e9f39a3154de0accc56ae644441edd76156d7429d995bdd88664a9dc3ad50197c38af1a0c16d684060441db02565e85f3b966
0d0713cc48a0ed6ef7dedc2dc60b17e92219e180643ed27acffba86e9c94c78ab90980d8a9f0913ee49d62b512b79626fb06dccee2a432bbc60276b9f7dec44b
7904cfbca4f3f6443ab2a49c9c2c41476dafd55c6e7ac8c769db1bc399161ee314bc2e75cf8759081743be1236ec4f4d6693e5336fb672c5dc24a8c33585b5fb
9cc24e1d4885545b58463634cc5416022cd19cacfccb4d30eb45296023fd35a458598360f8d7a4003bbaae25e331f155d9d9a5116d3bfb9a95523e51440ca2e0
088dd844ec6370bf0e55d027a012ae264c45d02f708fa6ad6da6dce29c255df9f6cae0ec38666984b372ab5334cf640b37795cc860de4ae2816e95b21be5ceaf
8a49f90b52a51cc6ff3355f47e0237052b81f6800fd7b802239daf6d8f0b1571a8426944fdbe80c6c1d40e8816b88b8569082ab84c36ff0539d4ff6dce591a26
ade1c0a7f669880485fd484582903d284b26fa4e2156cff62e4b9265844c4495c495a9157b440e091bea1ab8aaf7760f4510eaa69a6465c0e04ec69ffb9e65d0
28d44d4e39df9c1a52ecbd3607fee9cec7263328e5d661d3d0e4f62f44acd855ed7ab33cdf7bcb8ae889599bd5c8b3029895b6825696f6af29c239b75a5bb1e6
345e6ee6c28117e73586c1a2214ae1be07e93fb0ff51e133fb65426fa843be0fb515c187064d0cc206a2fa926d3c902e907670048d931db4c1a44959d366ad93
b65abe595f70a75bf03d616c2dd959fc7d4e6317cd99cbcec9c58b34766661c7d6766ca1a9c1b327531486c6f941c638c67cd22a7f75e2a37be0e82db8df9f30
254d30c1372581a1f51c983c80e4b71ccdd28dbf000000ffff0300504b0304140006000800000021000dd1909fb60000001b010000270000007468656d652f74
68656d652f5f72656c732f7468656d654d616e616765722e786d6c2e72656c73848f4d0ac2301484f78277086f6fd3ba109126dd88d0add40384e4350d363f24
51eced0dae2c082e8761be9969bb979dc9136332de3168aa1a083ae995719ac16db8ec8e4052164e89d93b64b060828e6f37ed1567914b284d262452282e3198
720e274a939cd08a54f980ae38a38f56e422a3a641c8bbd048f7757da0f19b017cc524bd62107bd5001996509affb3fd381a89672f1f165dfe514173d9850528
a2c6cce0239baa4c04ca5bbabac4df000000ffff0300504b01022d0014000600080000002100828abc13fa0000001c0200001300000000000000000000000000
000000005b436f6e74656e745f54797065735d2e786d6c504b01022d0014000600080000002100a5d6a7e7c0000000360100000b000000000000000000000000
002b0100005f72656c732f2e72656c73504b01022d00140006000800000021006b799616830000008a0000001c00000000000000000000000000140200007468
656d652f7468656d652f7468656d654d616e616765722e786d6c504b01022d001400060008000000210096b5ade296060000501b000016000000000000000000
00000000d10200007468656d652f7468656d652f7468656d65312e786d6c504b01022d00140006000800000021000dd1909fb60000001b010000270000000000
00000000000000009b0900007468656d652f7468656d652f5f72656c732f7468656d654d616e616765722e786d6c2e72656c73504b050600000000050005005d010000960a00000000}
{\*\colorschememapping 3c3f786d6c2076657273696f6e3d22312e302220656e636f64696e673d225554462d3822207374616e64616c6f6e653d22796573223f3e0d0a3c613a636c724d
617020786d6c6e733a613d22687474703a2f2f736368656d61732e6f70656e786d6c666f726d6174732e6f72672f64726177696e676d6c2f323030362f6d6169
6e22206267313d226c743122207478313d22646b3122206267323d226c743222207478323d22646b322220616363656e74313d22616363656e74312220616363
656e74323d22616363656e74322220616363656e74333d22616363656e74332220616363656e74343d22616363656e74342220616363656e74353d22616363656e74352220616363656e74363d22616363656e74362220686c696e6b3d22686c696e6b2220666f6c486c696e6b3d22666f6c486c696e6b222f3e}
{\*\latentstyles\lsdstimax267\lsdlockeddef0\lsdsemihiddendef1\lsdunhideuseddef1\lsdqformatdef0\lsdprioritydef99{\lsdlockedexcept \lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority0 \lsdlocked0 Normal;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority9 \lsdlocked0 heading 1;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 2;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 3;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 4;
\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 5;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 6;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 7;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 8;\lsdqformat1 \lsdpriority9 \lsdlocked0 heading 9;
\lsdpriority39 \lsdlocked0 toc 1;\lsdpriority39 \lsdlocked0 toc 2;\lsdpriority39 \lsdlocked0 toc 3;\lsdpriority39 \lsdlocked0 toc 4;\lsdpriority39 \lsdlocked0 toc 5;\lsdpriority39 \lsdlocked0 toc 6;\lsdpriority39 \lsdlocked0 toc 7;
\lsdpriority39 \lsdlocked0 toc 8;\lsdpriority39 \lsdlocked0 toc 9;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdlocked0 caption;\lsdunhideused0 \lsdlocked0 List;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority10 \lsdlocked0 Title;
\lsdunhideused0 \lsdlocked0 Default Paragraph Font;\lsdunhideused0 \lsdlocked0 Body Text;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority11 \lsdlocked0 Subtitle;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority22 \lsdlocked0 Strong;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority20 \lsdlocked0 Emphasis;\lsdsemihidden0 \lsdunhideused0 \lsdpriority59 \lsdlocked0 Table Grid;\lsdunhideused0 \lsdlocked0 Placeholder Text;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority1 \lsdlocked0 No Spacing;\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading;\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid;\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading;\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List;\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 1;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 1;
\lsdunhideused0 \lsdlocked0 Revision;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority34 \lsdlocked0 List Paragraph;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority29 \lsdlocked0 Quote;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority30 \lsdlocked0 Intense Quote;\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 1;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 1;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 1;\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 1;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 2;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 2;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 2;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 2;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 2;\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 3;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 3;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 3;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 3;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 3;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 3;\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 4;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 4;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 4;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 4;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 4;\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 4;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 5;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 5;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 5;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 5;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 5;\lsdsemihidden0 \lsdunhideused0 \lsdpriority60 \lsdlocked0 Light Shading Accent 6;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority61 \lsdlocked0 Light List Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority62 \lsdlocked0 Light Grid Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority63 \lsdlocked0 Medium Shading 1 Accent 6;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority64 \lsdlocked0 Medium Shading 2 Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority65 \lsdlocked0 Medium List 1 Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority66 \lsdlocked0 Medium List 2 Accent 6;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority67 \lsdlocked0 Medium Grid 1 Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority68 \lsdlocked0 Medium Grid 2 Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority69 \lsdlocked0 Medium Grid 3 Accent 6;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority70 \lsdlocked0 Dark List Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority71 \lsdlocked0 Colorful Shading Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdpriority72 \lsdlocked0 Colorful List Accent 6;
\lsdsemihidden0 \lsdunhideused0 \lsdpriority73 \lsdlocked0 Colorful Grid Accent 6;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority19 \lsdlocked0 Subtle Emphasis;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority21 \lsdlocked0 Intense Emphasis;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority31 \lsdlocked0 Subtle Reference;
\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority32 \lsdlocked0 Intense Reference;\lsdsemihidden0 \lsdunhideused0 \lsdqformat1 \lsdpriority33 \lsdlocked0 Book Title;\lsdpriority37 \lsdlocked0 Bibliography;
\lsdqformat1 \lsdpriority39 \lsdlocked0 TOC Heading;}}{\*\datastore 0105000002000000180000004d73786d6c322e534158584d4c5265616465722e352e3000000000000000000000060000
d0cf11e0a1b11ae1000000000000000000000000000000003e000300feff090006000000000000000000000001000000010000000000000000100000feffffff00000000feffffff0000000000000000ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
fffffffffffffffffdfffffffeffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
ffffffffffffffffffffffffffffffff52006f006f007400200045006e00740072007900000000000000000000000000000000000000000000000000000000000000000000000000000000000000000016000500ffffffffffffffffffffffffec69d9888b8b3d4c859eaf6cd158be0f000000000000000000000000607e
b1fa7c95ca01feffffff00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000ffffffffffffffffffffffff00000000000000000000000000000000000000000000000000000000
00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000ffffffffffffffffffffffff0000000000000000000000000000000000000000000000000000
000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000ffffffffffffffffffffffff000000000000000000000000000000000000000000000000
0000000000000000000000000000000000000000000000000105000000000000}';

### START OF COLOR TABLE
define('BLACK', 	0);
define('DARKGRAY',	1);
define('LIGHTBLUE',	2);
define('CYAN',		3);
define('LIGHTGREEN',4);
define('PURPLE',	5);
define('RED', 		6);
define('YELLOW', 	7);
define('WHITE',		8);
define('BLUE', 		9);
define('DARKCYAN',  10);
define('DARKGREEN', 11);
define('DARKPURPLE',12);
define('BROWN',	    13);
define('DARKYELLOW',14);
define('GRAY',		15);
define('LIGHTGRAY', 16);
### END OF COLOR TABLE

class RTF{

	var $MyRTF;
	var $dfl_FontID;
	var $dfl_FontSize = 20;
	var $FontID;
	var $TextDecoration;
       var $previousResult = 0;
       var $Header='';
       var $Page='';
       var $Pages='';
       var $fsize=0;

	/**
	 * Creates the RTF file on RAM and writed the header
     * including the font table and the color table
	 * see also: load_color_table() e load_font_table()
     * @return void
	 */
	function RTF($rtffile=''){
          global $MSWORDFOOTER;
          if ($rtffile!='') {
           $this->fsize=filesize($rtffile)-1;
           $this->MyRTF=file_get_contents($rtffile,NULL,NULL,0,$this->fsize);
           $this->MyRTF = str_replace($MSWORDFOOTER, ' ', $this->MyRTF);


          }


          else {
		$this->MyRTF="{\\rtf1\\ansi\n";
        $this->load_color_table();
		$this->load_font_table();
        $this->config_margin();
        $this->MyRTF .= "\n{\n\n";
          }
	}

        function decodeRTF() {
          $pageini=strpos($this->MyRTF,"\\pard\\plain");
          $this->Header=substr($this->MyRTF,0,$pageini+11);
          $slen=strlen($this->MyRTF);
          $this->Page=substr($this->MyRTF,$pageini+12,$slen);
        }
	/**
	 * Loads the color table (RGB)
     * @return void
	 */
	function load_color_table(){

		$this->MyRTF.="{\\colortbl;\n".
                      "\\red0\\green0\\blue0;\\red0\\green0\\blue255;\\red0\\green255\\blue255;\n".
                      "\\red0\\green255\\blue0;\\red255\\green0\\blue255;\\red255\green0\\blue0;\n".
                      "\\red255\\green255\\blue0;\\red255\\green255\\blue255;\\red0\green0\\blue128;\n".
                      "\\red0\\green128\\blue128;\\red0\\green128\\blue0;\\red128\\green0\\blue128;\n".
                      "\\red128\\green0\\blue0;\\red128\\green128\\blue0;\\red128\\green128\\blue128;\n".
                      "\\red192\\green192\\blue192;\n".
                      "}\n";
	}

	/**
	 * Loads the fonts table
     * @return void
	 */
	function load_font_table(){

		$this->MyRTF.="{\\fonttbl\n".
					  "{\\f0\\froman\\fcharset0\\fprq2 Times New Roman;}\n".
					  "{\\f1\\fswiss\\fcharset0\\fprq2 Arial;}\n".
					  "{\\f2\\fswiss\\fcharset0\\fprq2 Arial Black;}\n".
					  "{\\f3\\fswiss\\fcharset0\\fprq2 Verdana;}\n".
					  "{\\f4\\fswiss\\fcharset0\\fprq2 Tahoma;}\n".
					  "{\\f5\\fmodern\\fcharset0\\fprq2 Courier New;}\n".
					  "}";
	}

	/**
	 * These two function will insert into the document the *CURRENT* time
     * and/or the *CURRENT* date. So, it's not the date of the last modify as these
     * values will change upon the opening of the generated document.
     * @return string
     */
	function cur_date() { return "\\chdate "; }
	function cur_time() { return "\\chtime "; }

	/**
	 * Creates a list taking values from an array using bullets.
     * @arg1		array
	 * @arg2		keyword  (left|center|right|justify)
	 * @return		void|NULL on failure
     */
	function add_list($array, $align = 'left'){

		if (!is_array($array)) return NULL;

		foreach ($array as $k => $v)
		{
            $this->align($align);
            $this->MyRTF .= "{ ";
			$this->bullet($v);
			$this->MyRTF .= "} ";
			$this->paragraph();
		}
	}

	/**
	 * Creates a list field using bullets.
     * @arg1	string
     * @arg2	keyword	(left|center|right|justify)
	 * @return	void
     */
	function bullet($text)
	{
        $this->TextDecoration .= "\\bullet  "; // 2 spaces are needed at the end for spacing the word from the bullet
        $this->add_text($text);
	}

	/**
     * Insert some text in the document
	 * @arg1	string
	 * @arg2	keyword  (left|center|right|justify)
	 * @return	void
	 */
	function add_text($msg, $align = 'left')
	{
		/** FIX RITORNI A CAPO **/
		$msg = str_replace("\r", "", $msg);
		$msg = str_replace("\n", "", $msg);

		/** FIX LETTERE ACCENTATE **/
		$msg = str_replace("à", "\\'e0", $msg);
		$msg = str_replace("è", "\\'e8", $msg);
		$msg = str_replace("é", "\\'e9", $msg);
		$msg = str_replace("ì", "\\'ec", $msg);
		$msg = str_replace("ò", "\\'f2", $msg);
		$msg = str_replace("ù", "\\'f9", $msg);

		$this->align($align);
		$this->MyRTF .= "{ ";

		if (empty($this->TextDecoration))
		{
			$this->TextDecoration .= $this->_font($this->dfl_FontID);
			$this->TextDecoration .= $this->_font_size($this->dfl_FontSize);
		}

        $this->MyRTF .= $this->TextDecoration;
		$this->MyRTF .= $msg;
		$this->MyRTF .= " } ";

		$this->TextDecoration = '';
	}

	/**
	 * Insert one or ${times} carriage returns in the document
	 * @arg1		int
     * @return 	void
     */
	function new_line($times = 1)
	{
		for ($i=0; $i<$times; $i++)
		{ $this->MyRTF .= "\\line\n";	}
	}

	/**
     * Ends the current paragraph (or thought to do so... duh)
     * @return void
     */
	function paragraph()			{ $this->MyRTF .= "\\par\n";  }

	/**
	 * Text formatting functions
     * bold:			grassetto
     * italic:			corsivo
	 * underline:		sottolineato
	 * caps:			testo in maiuscolo
	 * emboss:			effetto testo in rilievo
     * engrave:		    effetto testo scavato
     * outline:		    effetto testo con contorno
     * shadow:			effetto testo con ombra
	 * sub:				pedice
     * super:			apice
     * @arg1			int	(0|1) 1: default
     * @return			void
	 */
	function bold($s = 1)			{ return ($s == 0) ? " \\b0 " : "\\b "; 			}
	function italic($s = 1)			{ return ($s == 0) ? " \\i0 " : "\\i "; 			}
	function underline($s = 1)		{ return ($s == 0) ? " \\ulnone " : "\\ul "; 		}
	function caps($s = 1)			{ return ($s == 0) ? " \\caps0 " : "\\caps "; 		}
	function emboss($s = 1)			{ return ($s == 0) ? " \\embo0 " : "\\embo "; 		}
	function engrave($s = 1)		{ return ($s == 0) ? " \\impr0 " : "\\impr "; 		}
	function outline($s = 1)		{ return ($s == 0) ? " \\outl0 " : "\\outl "; 		}
	function shadow($s = 1)			{ return ($s == 0) ? " \\shad0 " : "\\shad ";	    }
	function sub($s = 1)		   	{ return ($s == 0) ? " \\nosupersub " : "\\shad ";  }
	function super($s = 1)			{ return ($s == 0) ? " \\nosupersub " : "\\super "; }

   /**
     * Internal function used to set the font type
     * (Not to be used directly. set_font() function as been written for this)
     * @arg1		int
     * @return		string
     */
	function _font($id = 0)			{ return ("\\f$id "); }

	/**
     * Internal function used to set the font size (X pt == X*2 pt)
     * (Not to be used directly. set_font_size() function as been written for this)
	 * @arg1		int
	 * @return		string
     */
	function _font_size($size = 20)		{ return ("\\fs$size "); }

	/**
	 * Sets the default font used in the document ( set_default_font() )
	 * used when the font is not assigned using set_font() function before
     * calling the add_text() function. Same thing for set_default_font_size().
     * @arg1		string
	 * @arg2		int
	 * @return 	void
     */
	function set_default_font($font_name, $font_size = 10 ){

		$this->dfl_FontID = $this->get_font_id($font_name);
		$this->set_default_font_size($font_size);
	}

	function set_default_font_size($font_size = 10)	{

		$this->dfl_FontSize = ($font_size * 2);
	}

	/**
	 * Returns the requested font id (used in RTF syntax)
     * @arg1		string
     * @return		int
     */
	function get_font_id($font_name = NULL)
	{
		switch ( strtolower($font_name) )
      {
			case 'times':        return(0); break;
   	        case 'arial':        return(1); break;
			case 'arial black':  return(2); break;
			case 'verdana':      return(3); break;
			case 'tahoma':       return(4); break;
 			case 'courier new':  return(5); break;
 			default:             return(0); break;
		}
	}

	/**
	 * Sets the font size only
     * @arg1		int
	 * @return		void
     */
	function set_font_size($size)
	{
		$size *= 2;
		$this->TextDecoration .= $this->_font_size($size);
	}

	/**
	 * Sets the text font and its size
     * @arg1		string	(font name)
     * @arg2		int		(font size)
	 * @return		void
	 */
	function set_font($font, $size = 10)
	{
		$this->FontID = $this->get_font_id($font);
		$this->TextDecoration .= $this->_font($this->FontID);
		$this->set_font_size($size);
	}

	/**
     * Jump to the next page of the document
     * @return		void
     */
	function new_page()				{ $this->MyRTF .= "\\page\n"; }

	/**
     * Sets the font's color
     * @return		void
     */
	function color($ColorID=0)		{ return "\\cf$ColorID "; }

	/**
     * Align text and images
     * (This is not intended to be used directly)
     * @arg1		keyword  (left|center|right|justify)
     */
	function align($where = 'left')
	{
		switch ( strtolower ($where) )
		{
			case 'left': 		$this->MyRTF .= "\\ql ";	break;
			case 'center':		$this->MyRTF .= "\\qc ";	break;
			case 'right':		$this->MyRTF .= "\\qr ";	break;
			case 'justify':	    $this->MyRTF .= "\\qj ";	break;
			default:			$this->align('left');		break;
		}
	}

	/**
     * Insert an image and manages its alignment on the document
	 * ** TODO ** :: fix bug on image size handling
     * @arg1		string	(image filename)
	 * @arg2		int		(int 1-100)
	 * @arg3		keyword  (left|center|right|justify)
	 * @return		void
     */
	function add_image($image, $ratio, $align = 'left')
	{
		$file = @file_get_contents($image);

		if (empty($file))
			return NULL;

		$this->align($align);
		$this->MyRTF .= "{";
		$this->MyRTF .= "\\pict\\jpegblip\\picscalex". $ratio ."\\picscaley". $ratio ."\\bliptag132000428 ";
		$this->MyRTF .= trim(bin2hex($file));
		$this->MyRTF .= "\n}\n";
		$this->paragraph();
	}

	/**
	 * View/Download of the created RTF files
     * NOTE: View feature is for *DEBUG* purposes
     * @arg1		string
	 * @return		void
	 */
	function display($filename = "document.rtf", $download = true)
	{
		$this->MyRTF .= "\n}\n}\n";

		if ($download == true) // Download
		{
			header("Content-type: application/msword");
			header("Content-Lenght: ". sizeof($this->MyRTF));
	   	        header("Content-Disposition: inline; filename=". $filename);
		}

		print $this->MyRTF;
	}

        function addPage($page) {
          $this->Pages.=($this->Pages=='')?$page:"\\page\n".$page;
        }
       	function show($filename = "document.rtf")
	{
		$this->MyRTF =$this->Header.$this->Pages."\n}\n}\n";

			header("Content-type: application/msword");
			header("Content-Lenght: ". sizeof($this->MyRTF));
	   	        header("Content-Disposition: inline; filename=". $filename);

		print $this->MyRTF;
	}



    /**
     * Method to set the margin of spacing (called the method "RTF")
     * @return		void
     */
    function config_margin($margl = 720, $margr = 720, $margt = 720, $margb = 720){

        ### Set the margins of the paper
        $this->MyRTF .= "\\paperw12240\\paperh15840\n";
        $this->MyRTF .= "\\margl".$margl."\\margr".$margr."\\margt".$margt."\\margb".$margb."\n";
    }

	/**
     * Method to set the font and font size for tables (called the method "RTF")
     * @return		void
     */
	function set_table_font($font_name, $size){

		$size = $size*2;
		$this->MyRTF .= "\\f".$this->get_font_id($font_name)."\\fs".$size."\n";
	}

    /**
     * Method to start the row of the table
     * @return		void
     */
    function open_line(){

        ### Mount the table within the document
        $this->MyRTF .= "\\trowd\\trgaph35\\trautofit1\\trpaddfr3\\trpaddfl3\\trpaddft3\\trpaddfb3\\trpaddr55\\trpaddl55\\trpaddb15\\trpaddt35\n";
    }

    /**
     * Method to close the line of table
     * @return		void
     */
    function close_line(){

        ### Go to the next line
        $this->MyRTF .= "\\pard \\intbl \\row\\pard\n";

        ### Zero for the previousResult a new line of table
        $this->previousResult=0;
    }

	/**
     * Method to skip lines
     * @return		void
     */
    function ln($times = 1){

        for ($i=0; $i<$times; $i++){
            $this->MyRTF .= "\\par\n";
        }
    }

    /**
     * Method for spacing with tab
     * @return		void
     */
    function tab($times = 1){

        for ($i=0; $i<$times; $i++){
            $this->MyRTF .= "\\tab\n";
        }
    }

    /**
     * Method for creating the cells of the table
     * @arg1		text
     * @arg2		size of the cell
	 * @arg3		keyword  (left|center|right|justify)
	 * @arg4		background colour of the cell
	 * @return		void
     */
    function cell($msg, $sizeCell, $align="left", $cellColorId = NULL){

        ### Calculate the size of the cell
        $sizeCell = (10800*($sizeCell/100)) + $this->previousResult;
        $this->previousResult = $sizeCell;

        ### Put the background color of the cell
        if ($cellColorId){$this->MyRTF .= "\\clcfpatraw".$cellColorId."\\clshdngraw10000\n";}

        ### Assemble the cells of the table (the sum of the sizes of the cells should not exceed 21,600)
        $this->MyRTF .= "\\cellx".$sizeCell."\n";

        $this->MyRTF .= "\\pard \\intbl ";
        $this->align($align);
        $this->MyRTF .= $msg." \\cell\n";
    }

    function getPage() {
     return $this->Page;
    }
    function replace($content,$metadata,$value) {

        $xchange = array ('\\' => "\\\\",
                               '{'  => "\{",
                               '}'  => "\}");

            $search = "%%".trim(strtoupper($metadata))."%%";

            foreach($xchange as $orig => $replace)
                $value = str_replace($orig, $replace, $value);

            $result= str_replace($search, $value, $content);
            return $result;
    }


}

?>