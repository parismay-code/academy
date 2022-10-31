INSERT INTO status (name, label, level)
VALUES ('visitor', 'Посетитель', 0),
       ('student', 'Студент', 1),
       ('assistant', 'Ассистент', 2),
       ('teacher', 'Преподаватель', 3),
       ('master', 'Магистр', 4),
       ('dean', 'Декан', 5),
       ('vice-rector', 'Проректор', 6),
       ('rector', 'Ректор', 7),
       ('admin', 'Администратор', 8);

INSERT INTO formation (name, leader_name, deputy_leader_name, lawyer_name)
VALUES ('Insignis', 'Johan Liebert', 'Nathan Young', 'Jacqueline de Monroe'),
       ('Camarilla', 'Gunter Knapp', 'Roxy Diaz', 'Mateo Gerrera'),
       ('Caedes', 'Jack Black', 'David Brown', 'Scott Sewell'),
       ('Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'),
       ('Gangrel', 'Aaron de Langeron', 'Aldo Delgado', 'Francis de Castan');

INSERT INTO lecture (status, creation_date, title, details)
VALUES ('submitted', NOW(), 'Наследие Первородных', 'Наследие Первородных является приказом Первородных, нарушение которого означает дефективность Сородича, так как силе приказа невозможно противиться, будучи нормальным.
Наследие Первородных напрямую связано с материалом, который будет даваться на следующих лекциях (Элизиум, Кровавый Договор и так далее).

Первое Наследие. Маскарад:
Сородич обязан держать в тайне и не выставлять на показ свою сущность в публичных местах.
Сородич никогда не раскроет тайну сущности другого Сородича человеку или представителю иной расы. От этого зависит выживание рода.
Если Сородич узнает, что природа другого раскрыта человеку или представителю иной расы - он должен незамедлительно сообщить об этом Серафимам, Канцлеру, Кардиналу или Первородным.
Если Сородич попал в плен и подвергается пыткам с целью выведать информацию о его сущности или о Сородичах в целом и попытки дезинформации, блефа и иные способы сохранить и не выдать тайну не увенчались успехом, Сородич должен сохранить тайну и пожертвовать собой ради рода. Способ, которым это будет сделано, он волен выбирать сам.
Если Сородич уличен в привязанности к оборотню, он будет казнен.
Сородич обязан помогать в маскараде другому Сородичу, быть максимально внимательным в использовании слов, присущих и понятных в рамках сообщества. Если случается оговорка, иметь запасную версию для ненавязчивого объяснения оной.

Второе Наследие. Закон Крови:
Вампирское сообщество и его защита - превыше всего.
В случае критической необходимости или зову Первородных, Сородичи обязаны объединиться для достижения общей цели.
Сородич не имеет права забрать священный амулет у другого Сородича без разрешения на то Главы своего формирования. Лидер свободной формации всегда может делегировать данную процедуру Сородичу своего формирования.
Сородич не имеет права полностью забирать кровь у другого Сородича.
Сородич обязан чтить иерархию сообщества и своей формации.
Виконт/Понтифик/Лорд могут быть переизбраны путем внутреннего голосования, если процент голосов составил 80 и более. Для переизбрания Виконта также потребуется одобрение от Первородных. Голосование должно проходить в Элизиуме в присутствии Кардинала, Канцлера и Первородных.
Кардинал, Канцлер и Первородные оставляют за собой право аннулировать результаты голосования.

Третье Наследие. Ответственность:
Ответственность за Дитя с момента его создания и до становления лежит на Сородиче, который даровал ему силу. Становление характеризуется проявлением жажды крови и изменением облика.
При любом нарушении Наследия нужно оповестить об этом Серафимов, Канцлера, Кардинала или Первородных.
Если Сородич нарушил Наследие, он подлежит казни.

Четвертое Наследие. Элизиум:
Кардиналом определяется нейтральная территория - Элизиум. В Элизиуме запрещено насилие в любом виде (нападение, причинение физического и иного вреда, использование силы и способностей с целью навредить, за исключением случаев самозащиты и в отношении сторонних от сообщества агрессоров, либо при исполнении приговора Изъятия Канцлером, Кардиналом или Первородными.
В Элизиуме, на прилегающей к нему территории и в непосредственной близости от этой территории запрещена охота.
Появление голодным на нейтральной территории возможно только в крайнем случае.
Представители Элизиума обязаны иметь запас крови, чтобы освежить голодного Сородича в случае крайней необходимости.
Элизиум устанавливается как место для собраний, переговоров или проведения Судов. В случае критических разногласий, в которых не удается прийти к мнению большинства, по запросу конфликтующих сторон может быть назначено Судебное Заседание во главе с Канцлером.
Элизиумом назначена территория отеля “Каллисто” и прилегающая к нему территория.
Запрещено обсуждать темы, касающиеся вампирского сообщества, а также проявлять свои способности на парковке и прилегающей к отелю территории.
Для соблюдения правил и обеспечения порядка в Элизиуме может быть назначен Хранитель Элизиума. Хранитель и сотрудники Элизиума для сохранности порядка и безопасности могут применять силу по отношению к нарушителям вплоть до нелетального воздействия.
Хранитель и сотрудники Элизиума в рамках соблюдения своих обязанностей и в зависимости от ситуации имеют право: сделать устное замечание, задержать или попросить удалиться нарушителей правил Элизиума с его территории. В случае многократных нарушений правил, Сородичу может быть отказано в дальнейшем доступе к территории Элизиума.
Любой приказ, нарушающий нейтралитет Элизиума невозможен.

Пятое Наследие. Кровавый договор:
Кровавый договор - любые письменные или вексельные договоренности между Сородичами, скрепленные их кровью.
Любой Сородич, заключивший кровавый договор, может расторгнуть его, уведомив об этом все остальные стороны данного договора, обозначив точное время прекращения исполнения всех обязательств по нему. Однако, если в договоре были оговорены условия его расторжения, Сородич обязан перед прекращением исполнения своих обязательств выполнить все, что оговорено.
Если условия кровавого договора нарушаются, то нарушителя ждет наказание по решению Канцлера, Кардинала и Первородных, вплоть до смертной казни.
Если нарушаются условия кровавого договора Секты/Клана/Лордства, то нарушителя ждет наказание по решению Виконта/Понтифика/Лорда, вплоть до смертной казни.
Кровавый договор не может быть подписан под силой приказа.
В случае, если предметом кровавого договора является услуга, то данный факт может быть оформлен в виде Векселя.
При оформлении векселя, сторона, предлагающая свою услугу, ставит кровавый отпечаток в Вексель, отдавая его принимающей стороне. Принимающая сторона ставит свой отпечаток в Вексель только в тот момент, когда услуга исполнена, вместе с тем возвращая сам Вексель второй сторон.

Шестое Наследие. Знание - сила:
Каждый новый Сородич обязан пройти общий курс Академии Ночи и сдать экзамен по итогам обучения в течение трех недель с момента принятия в Секту/Клан/Лордство.'),
       ('submitted', NOW(), 'Королевская семья и иерархия вампирского сообщества', 'План лекции:
Королевская семья
Иерархия сообщества и приказов
Формации
Кровавый трибьют

Королевская семья:
Королевская семья это семья Первородных. Всего известно о проживании на острове четырех:
Ethan de Langeron - Отец основатель линии крови, также известен как сотрудник D.O.A. - Капитан Палмер.
Aaron de Langeron - старший сын Итана, глава независимого Лордства Gangrel (для представителей иных рас известны как Outlanders).
Victoria de Langeron - дочь Итана, глава независимого Лордства King’s Landing (Королевская гавань).
Adam de Langeron - младший сын Итана, появился на острове относительно недавно.
Госпожа де Ланжерон проводит церемонии награждения Сородичей и еженедельную аудиенцию (по воскресеньям в 22:00) совместно с Кардиналом Солом Дюре.
Также существует история о том, как сообщество узнало о ее существовании. Господин Аарон де Ланжерон сообщил о том, что Виктория де Ланжерон находится в лаборатории Humane Labs и поручил провести специальную операцию по ее освобождению. Подробнее об этом расскажут на лекции номер 6.

Иерархия сообщества и приказов:

Первородные (обладают силой приказа над всеми Сородичами)
↓
Кардинал (обладает силой приказа над всеми Сородичами)
↓
Канцлер (обладает силой приказа над Сородичами, являющимися сторонами во время судебного процесса)
↓
Хранитель Элизиума, Ректор Академии Ночи, Серафим, Префект
(Хранитель Элизиума и Ректор Академии ночи обладают силой приказа над своими сотрудниками)
↓
Виконт (обладает силой приказа над всеми Сородичами, принадлежащими его Секте)
↓
Легат, Адъютор (обладают силой приказа над всеми Сородичами, принадлежащими их Секте)
↓
Понтифик
↓
Архонт, Юстициарий
↓
Лорд (обладает силой приказа над всеми Сородичами, принадлежащими его Лордству)
↓
Примоген, Хранитель
↓
Сородич

Первородные - верхушка нашего сообщества. Они имеют безграничную силу и власть над всеми Сородичами.

Кардинал - условно свободный вампир, избираемый Первородными. Является исполнителем воли Первородных и имеет власть над всеми Сородичами. Кардинал является хозяином Элизиума. В настоящий момент Кардиналом является господин Sol Dure.

Канцлер - условно свободный вампир, избираемый Первородными. В его обязанности входит проведение судов, контроль за соблюдением Наследия Первородных, а также сбор Кровавого Трибьюта. Канцлер следит за состоянием каждой формации и к нему следует обращаться по поводу создания новых. Имеет силу приказа во время проведения судебных заседаний над Сородичами, выступающими в них сторонами. В настоящий момент Канцлером является господин Shaquille de Castan.

Хранитель Элизиума - условно свободный вампир, избираемый Кардиналом. В его обязанности входит администрирование работы, а также контроль соблюдения правил в Элизиуме. Обладает силой приказа над сотрудниками, заключившими кровавый договор с Элизиумом, только в рамках его работы. В настоящий момент Хранителем Элизиума является господин Nathan Rivera.

Ректор Академии Ночи - условно свободный вампир, избираемый Кардиналом. Ректор отвечает за стабильную работу Академии Ночи и соблюдение правил на ее территории. Имеет силу приказа над сотрудниками, заключившими кровавый договор с Академией Ночи, в рамках ее работы. На данный момент Ректор Академии Ночи не назначен, исполняющим его обязанности является госпожа Jacqueline de Monroe.

Виконт - глава Секты. Обладает силой приказа над всеми Сородичами, входящими в его Секту. Обладает способностью даровать становление Сородичу, также способен к частичному обращению конечностей, контролю собственной регенерации и умеет уходить в дым. В истинной сущности обладает силой голоса, что позволяет ему беспрепятственно излагать свои мысли и передавать их на огромном расстоянии другим Сородичам. Помимо этого имеет уникальный вид, около 2.5 метров ростом с вытянутыми ушами и огромными конечностями. Максимально приближенный вид истинной сущности к Виконту имеют Легат и Адъютор.

Легат - правая рука Виконта, его прямой заместитель. Обладает силой приказа над всеми Сородичами, входящими в его Секту. В истинной сущности, так же, как и Виконт, обладает силой голоса.

Адъютор - второй заместитель Виконта, отвечающий за соблюдение Наследия Первородных и других правил сообщества внутри Секты. Следит за составами всех входящих Кланов и Лордств Секты и своевременно передает их Канцлеру. В истинной сущности, так же, как и Виконт обладает силой голоса.

Понтифик - глава Клана. Не обладает силой приказа, однако, как и Виконт, обладает способностью даровать становление Сородичу. В истинной сущности обладает силой голоса и более выраженной мускулатурой, большими размерами тела, нежели другие Сородичи. Способен к частичному обращению частей своего тела, также как и Виконт может ощущать Сородичей, входящих в его клан. Помимо перечисленных способностей, Понтифик может обращаться в дым.

Архонт - правая рука Понтифика, его первый заместитель. В истинной сущности не имеет отличий от иных сородичей.

Юстициарий - второй заместитель Понтифика, следить за исполнением Наследия Первородных и иных правил в Клане. Если находится внутри Секты, то взаимодействует с Адъютором, помогая следить за порядком в Клане.

Лорд - глава Лордства. Обладает силой приказа над Сородичами, входящими в его Лордство и имеет способность даровать становление Сородичу. В истинной сущности выглядит как летучая мышь огромных размеров и обладает силой голоса.

Примоген - правая рука Лорда, его первый заместитель. Никак не отличается от иных Сородичей в истинной сущности.
Хранитель - второй заместитель Лорда. Так же, как и Адъютор с Юстициарием, отвечает за порядок и соблюдение Наследия Первородных, но уже в Лордстве. В истинной сущности от других Сородичей никак не отличается.

Адъюторы, Юстициарии и Хранители формаций вправе присутствовать на Судебных Заседаниях, проводимых Канцлером.

Вне зависимости от того, в какой формации вы находитесь, необходимо чтить иерархию сообщества и относиться к Сородичам, находящимся выше по статусу с надлежащим уважением.

Если вы никогда не видели Сородича, который находится выше вас по статусу, то с обретением силы и полным становлением вы научитесь определять их, когда они находятся рядом с вами на уровне инстинктов. Вы не будете знать, что именно за Сородич перед вами, однако его статус даст о себе знать.

Сородич может находиться в подчинении сразу нескольких глав свободных формаций. К примеру, Сородич, находящийся в Секте, может работать в Элизиуме и являться преподавателем в Академии Ночи. Соответственно, он будет подчиняться приказам своего Виконта, Хранителя Элизиума и Ректора Академии Ночи.

Виды формаций:
Секта - самая крупная из возможных формаций. Создать свою Секту Сородичи могут при соблюдении условия, что у них есть 60 и более Сородичей-единомышленников, готовых подчиняться избранному Виконту.

Клан - средняя по величине формация. Создать свой Клан могут только Сородичи из трех Лордств, объединившись и выбрав Понтифика, которому готовы подчиняться. Также, для создания Клана требуется, чтобы суммарное количество Сородичей в Лордствах было более 30.

Лордство - самая малая по величине формация. Для создания Лордства необходимо, чтобы 8 и более Сородичей-единомышленников собрались и избрали Лорда, которому готовы подчиняться. Также, для создания Лордства необходимо иметь территорию, которая вследствие создания Лордства станет их Доменом.

Домен - территория, на которой проживают Сородичи. Принадлежит высшей по размеру формации, к которой относятся проживающие на ней Сородичи.

Существующие формации:
Секты:
Insignis (Отмеченные)
Виконт - Johan Liebert
Легат - Nathan Young
Адъютор - Jacqueline de Monroe

Кланы, входящие в Insignis:
Ad Mortem (Смертники), Понтифик - Anthony Redgrave

Caedes
Виконт - Jack Black
Легат - David Brown
Адъютор - Scott Sewell

Кланы, входящие в Caedes:
Assamites, Понтифик - Aldo Delgado
Messores, Понтифик - Winni Hukler

Camarilla
Виконт - Gunter Knapp
Легат - Roxy Diaz
Адъютор - Mateo Gerrera

Кланы, входящие в Camarilla:
Ventrue, Понтифик - Kyle Harvey
Catharsis, Понтифик - Isabel Valdez
Hunters, Понтифик - Timothee Grayson

Независимых Кланов на данный момент не существует.

Независимые Лордства:
Gangrel (Outlanders для смертных)
Глава - Aaron de Langeron
Sabbat (Guns’n’Roses для смертных)
Глава - Schwein Fettes
Примоген - Wendy Farrel Osborn
Хранитель - Dustin Ross
King’s Landing (Королевская гавань)
Глава - Victoria de Langeron

Лордство King’s Landing собрало внутри себя Рыцарей Королевской Гавани в лицах:
Johan Liebert (Виконт Insignis), Jack Black (Виконт Caedes), Adam McKinley (известен как “50-й”), Joel Briggs (Серафим).

Кровавый Трибьют:
Кровавый трибьют это налог за каждого Сородича, находящегося в формации, который оплачивается в пользу Первородных. Из собираемых средств организуется бесперебойная работа Элизиума, Академии Ночи, а также средства направляются на прямые нужды сообщества.
Выплаты для формаций:
Секта - 15 динар за каждого Сородича;
Независимый Клан - 20 динар за каждого Сородича;
Независимое Лордство - 30 динар за каждого Сородича.'),
       ('submitted', NOW(), 'Титульная система вампирского сообщества', 'Титул - не материальный вид награды Сородича за выдающиеся успехи перед сообществом, а также вклад в его развитие.

Виды титулов:
Все титулы разделяются на три группы: Социальные, Боевые и Собирательные.
Собирательные титулы также делятся на малые и один большой. Большой собирательный титул Префект является высшим титулом, который может получить Сородич.

Социальные:
Дипломат - вампир, который активно развивает экономическую и социальную составляющую вампирского сообщества среди смертных.

Примас - вампир, который долгое время является вампиром, показывает себя с лучшей стороны и развивает сообщество в сферах, которые не были отделены специальными титулами.

Эмиссар - вампир, который создает и развивает жизнь вампирского сообщества в сферах обучения, организации как развлекательных, так и боевых мероприятий (пример: Турнир Первородных).

Меценат - вампир, который удостоился чести продемонстрировать перед сообществом свои творческие навыки в сферах музыки, искусства и прочих.

Серафим - вампир, который обрел доверие Первородных, демонстрируя наглядный пример порядочного Сородича и развивая сообщество. Обладатель титула становится условно свободным вампиром, находящимся в подчинении только перед Кардиналом и Первородными. Имеет возможность создать собственное формирование, но только с одобрения Первородных и входит во Внутренний Круг. Не идет в учет социальных титулов для малого собирательного титула Регент.

Боевые:
Боевые титулы Охотник и Чемпион делятся на два ранга. Для того, чтобы получить второй ранг, необходимо выполнить все те же условия. Для подтверждения титула не существует обозначенных сроков, сородич может получить титул в самом начале своего формирования, а подтвердить его через неопределенное количество времени.
Сородич, который был награжден одним из титулов второго ранга может подтверждать его и далее, однако никаких дополнительных привилегий или наград за это выдано не будет, лишь упоминание о заслугах на церемонии награждения.

Охотник (I и II ранга) - вампир, который показывает хорошие показатели на охоте в истинной сущности или своем человеческом обличии. Под показателями в охоте считается количество поверженных жертв в истинной сущности или количество добытых трофеев в знак доказательства победы на существом в человеческом отличии.

Чемпион (I и II ранга) - вампир, который одержал победу на Турнире Первородных. Для получение чемпиона I ранга необходимо занять первое или второе место на турнире. Для подтверждения титула необходимо занять строго первое место.

Дреджен - вампир, который проявил выдающиеся боевые качества и сноровку в военном деле, регулярно являлся руководителем боевых операций, либо поставил свою жизнь на защиту сообщества.

Собирательные:
Регент - малый собирательный титул за обладание двумя или более титулами социальной группы (кроме Серафима). Входит во Внутренний Круг и получает возможность сделать особую татуировку, пигмент которой, попадая под кожу и смешиваясь с кровью вампира, позволяет полностью заменить амулет и защитить Сородича от солнечного воздействия.

Центурион - малый собирательный титул за обладание четырьмя или более титулами боевой группы. Входит во Внутренний Круг, а его истинная сущность изменяется, делая обладателя титула сильнее остальных Сородичей. Силу Центуриона можно сравнить с силой Лорда, исключая силу приказа.

Префект - большой собирательный титул за обладание всеми малыми собирательными титулами (Регент и Центурион). Обладатель титула
 сохраняет все бонусы малых собирательных титулов и становится условно свободным вампиром, находящимся в подчинении только перед Кардиналом и Первородными. Имеет возможность создать собственное формирование, без чьего-либо одобрения.

Серафимы нашего сообщества:
Nicolas Dark (погиб);
Elton LeBlank;
Joel Briggs (Рыцарь Королевской Гавани);
Veronica Escamilla Altamirano (погибла);
Sara Escamilla Altamirano;
Leon Wesker;
Francis de Castan (представитель Независимого Лордства Gangrel);
Aldo Chelsea (представитель Независимого Лордства Gangrel);
Schwein Fettes (Лорд Независимого Лордства Sabbat);
Roxy Diaz (Легат Секты Camarilla);
Shaquille de Castan (Канцлер, десница Виктории де Ланжерон);'),
       ('new', NOW(), 'Элизиум', 'Скоро'),
       ('new', NOW(), 'Кровавый договор', 'Скоро'),
       ('new', NOW(), 'Основы физиологии вампиров', 'Скоро'),
       ('new', NOW(), 'Истинная сущность', 'Скоро'),
       ('archived', NOW(), 'История боевых действий и вооруженных конфликтов', 'Скоро'),
       ('archived', NOW(), 'История вампирского сообщества', 'Скоро'),
       ('archived', NOW(), 'Производство формаций', 'Скоро');

INSERT INTO schedule_day (type, day, `to`)
VALUES ('lecture', 17, 21),
       ('vacation', 17, 21),
       ('lecture', 17, 21),
       ('vacation', 17, 21),
       ('lecture', 17, 21),
       ('attestation', 17, 21),
       ('examination', 17, 21);

INSERT INTO day_lecture (day_id, time, is_free)
VALUES (1, 17, true),
       (1, 18, true),
       (1, 19, true),
       (1, 20, true),
       (2, 17, true),
       (2, 18, true),
       (2, 19, true),
       (2, 20, true),
       (3, 17, true),
       (3, 18, true),
       (3, 19, true),
       (3, 20, true),
       (4, 17, true),
       (4, 18, true),
       (4, 19, true),
       (4, 20, true),
       (5, 17, true),
       (5, 18, true),
       (5, 19, true),
       (5, 20, true),
       (6, 17, true),
       (6, 18, true),
       (6, 19, true),
       (6, 20, true),
       (7, 17, true),
       (7, 18, true),
       (7, 19, true),
       (7, 20, true);