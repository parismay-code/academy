INSERT INTO formations (name, leader_name, deputy_leader_name, lawyer_name)
VALUES
  ('Insignis', 'Johan Liebert', 'Nathan Young', 'Jacqueline de Monroe'),
  ('Camarilla', 'Terry Silva', 'Roxy Diaz', 'Mateo Gerrera'),
  ('Caedes', 'Jack Black', 'David Brown', 'Scott Sewell'),
  ('Brujah', 'Gunter Knapp', 'Timothee Grayson', 'Mikaela Teller'),
  ('Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'),
  ('Gangrel', 'Aaron de Langeron', 'Aldo Delgado', 'Francis de Castan');

INSERT INTO users (username, fivem_id, discord, password, formation_id, status, registration_date)
VALUES
  ('Emiel Regis van der Eretein', 9737, 'mentalaffect#6666', 'kkapass02', 1, 'teacher', NOW()),
  ('Jacqueline de Monroe', 8855, 'Zlaya#0007', 'pass', 1, 'vice-rector', NOW()),
  ('Mikaela Teller', 1255, '.Di#5151',  'pass', 2, 'dean', NOW());

INSERT INTO lectures (status, creation_date, title, details)
VALUES
  ('submitted', NOW(), 'Наследие Первородных', 'Первое Наследие. Маскарад.
- Сородич обязан держать в тайне и не выставлять напоказ свою сущность в публичных местах.
- Сородич никогда не раскроет тайну сущности другого Сородича человеку или представителю иной расы. От этого зависит выживание рода.
Если Сородич узнает, что природа другого раскрыта человеку или представителю иной расы - он должен незамедлительно сообщить об этом Серафимам, Канцлеру, Кардиналу или Первородным.
- Если Сородич попал в плен и подвергается пыткам с целью выведать информацию о его сущности или о Сородичах в целом, и попытки дезинформации, блефа и иные способы сохранить жизнь и не выдать тайну, не увенчались успехом, Сородич должен сохранить тайну и пожертвовать собой ради рода. Способ, которым это будет сделано, он волен выбирать сам.
- Если Сородич уличен в привязанности к оборотню, он будет казнен.
- Сородич обязан помогать в маскараде другому сородичу, быть максимально внимательным в использовании слов, присущих и понятных в рамках сообщества-. Если случается оговорка, иметь запасную версию для ненавязчивого объяснения оной.

Второе Наследие. Закон Крови.
- Вампирское сообщество и его защита - превыше всего.
- В случае критической необходимости или зову первородных, Сородичи обязаны объединиться для достижения общей цели.
- Сородич не имеет права забрать священный амулет с Сородича, без разрешения на то Главы своего формирования. Лидер свободной формации всегда может делегировать данную процедуру сородичу своего формирования.
- Сородич не имеет права полностью забирать кровь у другого Сородича.
- Сородич обязан чтить иерархию сообщества и своей семьи.
- Виконт/Понтифик/Лорд может быть переизбран путем внутреннего голосования, если процент голосов составил 80 и более. Для переизбрания Виконта также потребуется одобрение от Первородных. Голосование должно проходить в Элизиуме, в присутствии Кардинала, Канцлера и Первородных.
- Кардинал, Канцлер и Первородные оставляют за собой право аннулировать результаты голосования.

Третье Наследие. Ответственность.
- Ответственность за Дитя с момента его создания и до становления лежит на сородиче, который даровал ему силу. Становление характеризуется проявлением жажды крови и изменением облика.
- При любом нарушении Наследия, нужно оповестить об этом Серафимов, Канцлера, Кардинала или Первородных.
- Если Сородич нарушил Наследие он подлежит казни.

Четвертое Наследие. Элизиум.
- Кардиналом определяется нейтральная территория - Элизиум. В Элизиуме запрещено насилие в любом виде (нападение, причинение физического и иного вреда, использование силы и способностей с целью навредить, за исключением случаев самозащиты и в отношении сторонних от сообщества агрессоров, или исполнения приговора Изъятия Канцлером, Кардиналом, или Первородными).
- В Элизиуме, на прилегающей к нему территории и в непосредственной близости от этой территории запрещена охота.
- Появление голодным на нейтральной территории возможно только в крайнем случае.
- Представители Элизиума обязаны иметь запас крови, чтобы освежить голодного Сородича в случае крайней необходимости.
- Элизиум устанавливается как место для собраний, переговоров и проведения Судов. В случае критических разногласий, в которых не удается прийти к мнению большинства,
По запросу конфликтующих сторон может быть назначено Судебное Заседание во главе с Канцлером.
- Элизиумом назначена территория отеля “Каллисто” и прилегающая к ней территория.
- Запрещено обсуждать темы касающиеся вампирского сообщества, а также проявлять свои способности на парковке, и прилегающей к отелю территории.
Для соблюдения правил и обеспечения порядка в Элизиуме, может быть назначен Хранитель Элизиума. Хранитель и сотрудники Элизиума, для сохранности порядка и безопасности могут применять силу по отношению к нарушителям вплоть до не летального воздействия.
- Хранитель и сотрудники Элизиума в рамках соблюдения своих обязанностей и в зависимости от ситуации имеют право: сделать устное замечание, задержать или попросить удалиться нарушителей правил Элизиума с его территории. В случае многократных нарушений правил, сородичу может быть отказано в дальнейшем доступе к территории Элизиума.
- Любой приказ заставляющий нарушить нейтралитет и правила Элизиума невозможен.

Пятое Наследие. Кровавый договор.
Кровавый договор - любые письменные или вексельные договоренности между сородичами скрепленные их кровью.
Любой Сородич, заключивший кровавый договор, может расторгнуть его, уведомив об этом все остальные стороны данного договора, обозначив точное время прекращения исполнения всех обязательств по нему. Однако, если в договоре были оговорены условия его расторжения, Сородич обязан перед прекращением исполнения обязательств выполнить все, что было оговорено.
Если условия кровавого договора нарушаются, то нарушителя ждет наказание по решению Канцлера, Кардинала и Первородных, вплоть до смертной казни.
Если нарушаются условия кровавого договора секты/клана/лордства, то нарушителя ждет наказание по решению Виконта/Понтифика/Лорда, вплоть  до смертной казни.
Кровавый договор не может быть подписан под силой приказа
В случае если предметом кровавого договора является услуга, то данный факт может быть оформлен в виде Векселя.
При оформлении векселя, сторона предлагающая свою услугу ставит кровавый отпечаток в Вексель, отдавая его принимающей стороне. Принимающая сторона ставит свой отпечаток в Вексель только в тот момент, когда услуга исполнена, вместе с тем возвращая сам вексель второй стороне.

Шестое Наследие. Знание - сила
Каждый новый сородич обязан пройти общий курс обучения в Академии Ночи и сдать экзамен по итогам обучения в течении 3х недель с момента принятия в секту/клан/лордство.'),
  ('submitted', NOW(), 'Королевская семья и иерархия вампирского сообщества', 'Темы:
Королевская семья
Иерархия сообщества
Иерархия приказов
Группы формирования
Кровавый трибьют

Королевская семья - это семья первородных. Всего известно о 4-х первородных:
Итан Де Ланжерон - отец основатель нашей линии крови, также он является Капитаном D.O.A. - Капитан Палмер
Аарон Де Ланжерон - старший сын Итана, Лорд независимого лордства Gangrel.
Виктория Де Ланжерон - дочь Итана, Лорд независимого лордства Королевская Гавань. Также Мисс Виктория проводит церемонии награждения титулами, и по воскресеньям в 22:00 проходит аудиенция, где можно задать интересующие вас вопросы.
Адам Де Ланжерон - младший сын Итана, относительно недавно появился на острове.
Есть интересная история, о том как мы узнали о Мисс Виктории. В нашем сообществе по просьбе Аарона была проведена спец. операция по освобождению Мисс Виктории из лаборатории Human Labs. О ней вы сможете узнать больше, на лекции №8 Боевые действия в нашем сообществе.

Иерархия нашего сообщества:
Первородные -> Кардинал -> Канцлер -> Префект, Хранитель Элизиума, Ректор Академии Ночи, Серафим -> Виконт -> Легат, Адьютор -> Понтифик -> Архонт, Юстициарий -> Лорд -> Примоген, Хранитель -> Сородич

Первородные - это верхушка нашего сообщества. Они имеют безграничную силу и власть над всеми, кто стоит ниже их по иерархии.
Кардинал - это условно свободный вампир, определяемый Первородными. Является опытным вампиром, который выполняет волю Первородных и управляет сородичами ниже его по иерархии от лица Первородных. Также Кардинал - это Хозяин Элизиума. На данный момент это Соул Дюре.

Канцлер - это условно свободный вампир, определяемый Первородными. В его обязанности входит проведение судов, контроль за соблюдением наследия, а также сбор Кровавого Трибьюта. Имеет силу приказа только во время проведения судов. На данный момент это Серафим и Десница Мисс Виктории - Шакил Де Кастан.

Хранитель Элизиума также является условно свободным вампиром. Его определяет Кардинал. Он отвечает за работу Элизиума, а также контроль за соблюдением правил на его территории. Имеет силу приказа только над сотрудниками Элизиума, и только в рамках работы. На данный момент это Нейтан Ривера.

Ректор Академии Ночи - условно свободный сородич, определяемый Кардиналом. Ректор отвечает за работу Академии Ночи и за соблюдение правил на её территории. Имеет силу приказа только над сотрудниками Академии Ночи, в рамках ее работы. На данный момент это Чон Ду Хван.

Виконт - это первое лицо секты представляющий ее интересы. Обладает силой приказа только над сородичами внутри своего формирования и в Истинной Сущности физиологически и визуально отличается от других сородичей.

Легат - это правая рука Виконта или же его прямой заместитель. Также имеет силу приказа над сородичами внутри секты, к которой относится, и в Истинной Сущности физиологически и визуально отличается от других сородичей.

Адъютор - это левая рука Виконта, которая обеспечивает соблюдение наследия первородных, традиций секты и кровавого договора секты. Имеет силу приказа над сородичами внутри секты и в Истинной Сущности физиологически и визуально отличается от других сородичей.

Понтифик - это тот сородич, который является главой клана, свободного или же зависимого. Силы приказа у Понтифика нету, но она может присутствовать только в случае совмещения статуса с Лордом (в этом случае сила приказа работает на сородичей внутри лордства). Истинная сущность отличается от других сородичей.

Архонт - это заместитель Понтифика. В Истинной Сущности никак не отличается от других сородичей. Выбирается Понтификом.

Юстициарий - это левая рука Понтифика, которая отвечает за соблюдение Наследия Первородных, традиций клана и кровавого договора клана. Визуально не отличается от других сородичей.

Лорд - лидер лордства, собравший в своем формировании 8 сородичей. Получает определённые силы: при прохождения кровавого обряда имеет силу приказа над сородичами своего формирования и в Истинной Сущности отличается от других сородичей.

Примоген - это заместитель Лорда. Истинная Сущность никак не отличается от других сородичей. Выбирается Лордом.

Хранитель - это левая рука Лорда, которая отвечает за соблюдение Наследия Первородных, традиций лордства и кровавого договора лордства. Истинная Сущность не отличается от других сородичей.

Независимо от того в каком формировании вы находитесь, нужно понимать и осознавать иерархию нашего сообщества. Необходимо уважительно относится к сородичам, которые имеют статусы выше вашего.

Есть случаи когда у сородича может быть не 1, а 2 лорда. Например, сородич может также работать в Академии ИЛИ в Элизиуме, и после прохождения кровавого обряда с Господином Чон Ду Хван ИЛИ с Господином Нейтаном Риверой, они становятся для сородича Лордом. (Если у вас будет договоренность, что вы будете и можете работать, что в Академии, что в Элизиуме. То Лордов может быть и 3)

Группы формирования:
Секта. Является самым большим формированием. Когда в формировании собирается 60 и более сородичей, их группа приобретает статус секты. Лидером секты является Виконт, его заместители это Легат и Адъютор.

Клан. Среднее формирование. Когда собираются и объединяются три лордства, в которых насчитываются 30 и более сородичей, они могут зарегистрировать свое формирование как Клан, выбрав из состава Лордств Понтифика и его заместителей. Клан может быть как в секте, так и независимым, т.е. не находится в секте. Лидером клана является Понтифик, его заместители Архонт и Юстициарий.

Лордство. Малое формирование. Когда в группировке набирается 8 и более сородичей, то это формирование называется Лордство. Лидер группировки принимает статус Лорда, и он назначает себе Примогена и Хранителя.

Домен - это территория лордства, на которой проживают сородичи.

Известные секты, кланы, лордства:
Секты: Camarilla, Caedes, Insignis.
Независимые лордства: Guns’n’Roses, Gangrel, King’s Landing.

Кланы состоящие в сектах:
Camarilla: Ventrue, Catharsis, Brujah.
Caedes: Assamites, Messores.
Insignis: Ad Mortem, Lasombra.

Кровавый Трибьют:
Кровавый трибьют - это налог, который уплачивается каждым лидером формирования, а именно секты, независимого клана и независимого лордства, в пользу Первородных. Из этих средств формируется фонд, который потом распределяется на нужды всего вампирского сообщества.
Виконт секты выплачивает за каждого сородича 15 гильз.
Понтифик независимого клана выплачивает - 20 гильз.
Лорд независимого лордства по 30 гильз.'),
  ('submitted', NOW(), 'Титульная система вампирского сообщества', 'Что такое титул? Титулы присваиваются Первородными за особые заслуги Сородичей. При этом, титула невозможно лишиться (в отличие от статуса). Максимум отказаться от него во время награждения.

Существует 3 вида титулов:
Социальные
Боевые
Собирательные

Социальные:
1. Дипломат - Тот, кто активно развивает экономическую и социальную составляющую вампирского сообщества среди смертных.
2. Примас - Тот, кто долгое время является вампиром, показывает себя с лучшей стороны в вампирском сообществе ине был уличен в нарушении Наследия первородных.
3. Эмиссар - тот, кто создает и развивает жизнь вампирского сообщества.
4. Меценат - титул выдаваемый за проявления творческой натуры и деятельности в искусстве.
5. Серафим - титул выдаваемый за заслуги перед первородными. Условно-свободный вампир, находящийся в подчинении только перед Кардиналом и Первородными. Имеет возможность создать собственное формирование, только с одобрения Первородных. Не идет в счет социальных титуловдля сбора Регента.

Боевые:
1. Охотник (I и II ранга) - титул, выдаваемый за проявление хороших показателей на охоте в истинном и человеческом обличии. Делится на два ранга, чтобы получить Охотника II, нужно подтвердить свой первый титул. Чтобы подтвердить титул, необязательно его получать два раза подряд. Подтверждать титул можно неограниченное количество попыток.
2. Чемпион (I и II ранга) - титул, выдаваемый сородичу за победу на турнире Первородных. Для получение чемпиона I ранга нужно получить 1 или 2 место на турнире первородных. Для подтверждения титула нужно получить 1 место.
3. Дреджен - титул, выдаваемый за выдающиеся боевые качества и сноровку в военном деле.

Собирательные:
1. Регент - социальный малый собирательный титул. Обладатель двух любых социальных титулов. Получает доступ во внутренний круг и возможность получить особую татуировку, заменяет амулет.
2. Центурион - боевой малый собирательный титул. Обладатель 4 любых боевых титулов . Истинная сущность визуально и физиологически отличается от других сородичей и получает доступ во внутренний круг.
3. Префект - большой собирательный титул. Обладатель титулов Центурион и Регент. Выходит из под влияния своего Виконта/Понтифика и становится условно-свободным вампиром, находящимся в подчинении только перед Кардиналом и Первородными. Имеет возможность создать собственное формирование.

Статус - это то, что может заслужить сородич в сообществе, и он даст ему определённый авторитет и положение в иерархии сообщества. Но к этому же он может его и потерять.

Титул - это то, что присуждается сородичу Первородными за заслуги в сообществе. Титул выдается один раз и его невозможно потерять.
Примечание: от титула можно отказаться только на церемонии награждения.

Серафимы нашего сообщества:
Elton LeBlank - Серафим.
Joel Briggs - Серафим.
Veronica E. Altamirano - Серафим.
Sara E. Altamirano - Серафим.
Leon Wesker - Серафим.
Francis de Castan - Серафим.
Aldo Chelsea - Серафим.
Schwein Fetts - Серафим, Лорд независимого Лордства Guns''n''Roses.
Roxy Diaz - Серафим, Легат секты Camarilla.
Shaquille de Castan - Серафим, Канцлер и Десница мисс Victoria de Langeron.'),
  ('submitted', NOW(), 'Элизиум', 'Скоро появится');
