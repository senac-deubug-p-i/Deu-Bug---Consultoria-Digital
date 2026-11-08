<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
      tailwind = { config: { corePlugins: { preflight: false } } };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans%3Awght%40200..800&display=swap"
      rel="stylesheet"
    />
    <style>
      *, ::before, ::after {
        box-sizing: border-box;
      }

      body {
        margin: 0;
      }
    </style>

    <style>
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>
  </head>
  <body style="background-color: #08080A">
    <div
      data-pencil-name="Admin - Projetos"
      class="box-border w-[1440px] h-[920px] flex flex-row gap-0 justify-start items-start bg-[#08080A] overflow-hidden"
    >
      <div
        data-pencil-name="Sidebar"
        class="[box-sizing:content-box] w-[211.5px] shrink-0 h-[920px] flex flex-col gap-0 p-[20px_14px] justify-between items-start bg-[#0B0B0F] [border-width:0px_1px_0px_0px] [border-style:solid] [border-color:#1E1E26] [margin:0px_-0.5px_0px_0px]"
      >
        <div
          data-pencil-name="Sidebar Top"
          class="box-border w-full h-fit shrink-0 flex flex-col gap-[4px] justify-start items-start"
        >
          <div
            data-pencil-name="Brand"
            class="box-border w-fit h-fit shrink-0 flex flex-row gap-[10px] p-[0px_6px_18px_6px] justify-start items-center"
          >
            <div
              data-pencil-name="Logo Mark"
              class="box-border w-[34px] shrink-0 h-[34px] flex flex-col gap-0 justify-center items-center bg-[#7C3AED] rounded-[10px]"
            >
              <div
                data-pencil-name="Logo Text"
                class="text-[13px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-extrabold tracking-[-0.5px] text-left [white-space:nowrap]"
              >
                DI
              </div>
            </div>
            <div
              data-pencil-name="Brand Text"
              class="box-border w-fit shrink-0 h-fit flex flex-col gap-[1px] justify-start items-start"
            >
              <div
                data-pencil-name="Brand Name"
                class="text-[14.5px]/[normal] box-border text-[#F2F2F6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-extrabold text-left [white-space:nowrap]"
              >
                Deu Bug!
              </div>
              <div
                data-pencil-name="Brand Role"
                class="text-[8px]/[normal] box-border text-[#6B6B78] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold tracking-[1.6px] text-left [white-space:nowrap]"
              >
                ADMIN
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Nav"
            class="box-border w-full h-fit shrink-0 flex flex-col gap-[3px] p-[10px_0px_0px_0px] justify-start items-start"
          >
            <div
              data-pencil-name="Visão geral"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-[10px] p-[9px_10px] justify-start items-center rounded-[9px]"
            >
              <svg
                data-pencil-name="Icon"
                viewBox="0 0 15 15"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="layout-dashboard"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[15px] shrink-0 h-[15px] overflow-visible"
              >
                <path
                  d="M2.175 1.289q-.241 .077-.457 .249-.217 .172-.323 .396l-.029 .047q-.062 .117-.077 .224-.029 .15-.029 .6v3.765q0 .45 .029 .6 .015 .107 .077 .224l.029 .047q.106 .238 .33 .411 .223 .172 .48 .234 .12 .044 1.853 .037 1.732-.008 1.867-.037 .315-.077 .572-.33 .131-.135 .205-.249 .077-.113 .124-.293l.044-.135v-4.783l-.044-.135q-.047-.18-.124-.293-.074-.114-.205-.249-.165-.165-.315-.238l-.019-.015q-.131-.062-.238-.077-.135-.029-.509-.029h-1.23-1.637q-.267 .014-.374 .029zM9.075 1.289q-.301 .062-.572 .33-.131 .135-.208 .249-.074 .113-.121 .293l-.044 .135v2.307l.044 .15q.091 .242 .264 .436 .172 .194 .38 .3l.019 .015q.146 .077 .238 .092 .15 .014 .523 .029l3.135-.015 .15-.044q.286-.091 .502-.307 .22-.22 .311-.487 .03-.092 .03-.271l.014-1.022v-.93q0-.253-.029-.374-.015-.077-.092-.227l-.014-.014q-.106-.238-.322-.403-.217-.165-.473-.242-.106-.029-.359-.029h-1.516q-1.739 0-1.86 .029zM5.625 4.68v2.205h-3.135v-4.395h3.135zM12.51 3.435v.93h-3.135v-1.875h3.135zM9.075 6.914q-.301 .062-.572 .33-.131 .135-.208 .249-.074 .113-.121 .293l-.044 .135v4.783l.044 .135q.047 .18 .121 .293 .077 .114 .208 .249 .257 .253 .572 .33 .135 .029 1.867 .037 1.733 .007 1.853-.037 .33-.077 .583-.33 .256-.256 .333-.586 .029-.12 .037-2.482 .007-2.363-.037-2.483-.077-.33-.326-.575-.245-.249-.575-.341-.106-.029-.359-.029h-1.516q-1.739 0-1.86 .029zM12.51 10.305v2.205h-3.135v-4.395h3.135zM2.282 9.39q-.334 .058-.605 .293-.267 .23-.373 .545-.03 .092-.03 .271l-.014 1.022v.93q0 .253 .029 .374 .015 .077 .092 .227l.014 .014q.106 .238 .33 .411 .223 .172 .48 .234 .12 .044 1.853 .037 1.732-.008 1.867-.037 .315-.077 .572-.33 .131-.135 .205-.249 .077-.113 .124-.293l.044-.135v-2.307l-.044-.15q-.091-.242-.263-.436-.173-.194-.381-.3l-.019-.015q-.131-.062-.238-.092-.15-.014-.523-.029h-1.352q-1.666 0-1.768 .015zM5.625 11.565v.945h-3.135v-1.875h3.135z"
                  fill="#6b6b78"
                />
              </svg>
              <div
                data-pencil-name="Label"
                class="text-[12.5px]/[normal] box-border [flex:1_1_0] text-[#9A9AA6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left"
              >
                Visão geral
              </div>
            </div>
            <div
              data-pencil-name="Projetos"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-[10px] p-[9px_10px] justify-start items-center bg-[#7C3AED] rounded-[9px]"
            >
              <svg
                data-pencil-name="Icon"
                viewBox="0 0 15 15"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="folder"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[15px] shrink-0 h-[15px] overflow-visible"
              >
                <path
                  d="M2.117 1.289q-.513 .106-.898 .476-.38 .366-.531 .861-.043 .15-.043 .373-.015 .286-.03 1.216l.015 6.676q.015 .659 .029 .747 .15 .586 .553 .971 .407 .381 .978 .487 .179 .029 5.31 .029 5.131 0 5.31-.029 .571-.106 .982-.487 .413-.385 .549-.971 .015-.088 .029-.611v-2.776q.015-3.256 0-3.435-.077-.542-.373-.945-.392-.509-1.037-.692l-.15-.044-5.402-.015-.102-.044q-.121-.062-.183-.121-.059-.058-.359-.509-.238-.348-.374-.512-.135-.165-.271-.268-.12-.091-.285-.187-.165-.098-.282-.128-.227-.077-.462-.084-.23-.007-1.369-.007h-1.245q-.257 .014-.359 .029zM5.204 2.549q.121 .062 .187 .139 .069 .073 .362 .509 .293 .432 .473 .612 .359 .362 .853 .512l.15 .044h2.703q2.699 .015 2.757 .037 .063 .022 .15 .084 .092 .059 .136 .106 .044 .044 .091 .147l.044 .106v6.57l-.044 .106q-.12 .223-.347 .315l-.103 .029h-10.232l-.102-.029q-.228-.092-.348-.315l-.044-.106v-8.445l.044-.106q.062-.136 .179-.231 .121-.099 .271-.113 .106-.015 1.395-.015h1.308z"
                  fill="#ffffff"
                />
              </svg>
              <div
                data-pencil-name="Label"
                class="text-[12.5px]/[normal] box-border [flex:1_1_0] text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
              >
                Projetos
              </div>
            </div>
            <div
              data-pencil-name="Clientes"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-[10px] p-[9px_10px] justify-start items-center rounded-[9px]"
            >
              <svg
                data-pencil-name="Icon"
                viewBox="0 0 15 15"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="users"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[15px] shrink-0 h-[15px] overflow-visible"
              >
                <path
                  d="M5.189 1.289q-.868 .121-1.531 .663-.659 .538-.959 1.333-.194 .524-.194 1.095 0 .3 .044 .542 .047 .238 .15 .524 .165 .494 .502 .908 .34 .41 .772 .681 .392 .242 .788 .348 .399 .102 .864 .102 .242 0 .388-.014 .15-.015 .377-.063 .645-.164 1.183-.596 .542-.436 .857-1.052 .209-.421 .286-.944 .029-.15 .029-.436 0-.286-.029-.436-.106-.703-.498-1.289-.388-.586-1.004-.959-.465-.286-1.051-.392-.164-.03-.487-.037-.322-.007-.487 .022zM9.84 1.351q-.15 .044-.271 .15-.121 .103-.165 .286-.044 .18 0 .344 .044 .165 .165 .271 .121 .103 .363 .194 .267 .088 .432 .187 .165 .095 .329 .279 .363 .358 .487 .823 .129 .466 .015 .931-.11 .465-.447 .824-.337 .359-.835 .523-.208 .077-.307 .154-.095 .073-.172 .224-.059 .106-.059 .256 0 .146 .059 .253 .091 .208 .3 .315 .135 .062 .271 .054 .135-.011 .359-.084 .377-.121 .652-.293 .278-.172 .549-.458 .839-.838 .916-1.981 .106-1.274-.751-2.278-.524-.629-1.366-.915-.359-.121-.524-.059zM5.834 2.52q.436 .029 .838 .307 .407 .278 .623 .707 .22 .425 .198 .945-.022 .516-.308 .923-.165 .252-.406 .443-.238 .186-.495 .289-.209 .062-.307 .084-.096 .022-.352 .022-.256 0-.355-.022-.095-.022-.304-.084-.421-.15-.729-.502-.308-.351-.428-.787-.118-.494 .014-.974 .136-.48 .487-.824 .356-.348 .85-.484 .091-.029 .264-.051 .172-.022 .23-.007zM3.314 8.789q-1.032 .15-1.769 .886-.586 .586-.809 1.41-.077 .257-.091 .473-.015 .216-.015 .879v.824l.044 .12q.062 .103 .15 .194 .227 .209 .542 .158 .315-.051 .45-.337l.044-.106 .015-.853q.015-.663 .029-.828 .015-.165 .077-.374 .15-.406 .502-.728 .351-.323 .787-.444 .165-.043 .575-.058 .414-.015 1.78-.015 1.366 0 1.776 .015 .414 .015 .579 .058 .45 .121 .809 .462 .363 .337 .494 .769 .063 .179 .07 .348 .007 .165 .022 .795l.015 .853 .044 .106q.135 .286 .45 .337 .315 .051 .542-.158 .088-.091 .15-.194l.044-.12v-.824q0-.663-.014-.879-.015-.216-.092-.473-.088-.344-.253-.659-.285-.557-.791-.967-.501-.414-1.098-.578l-.048-.015q-.179-.062-.315-.077-.165-.015-.601-.015l-1.724-.014q-2.205 0-2.37 .029zM11.73 8.851q-.257 .059-.392 .293-.132 .231-.059 .487 .063 .209 .227 .33 .074 .044 .301 .135 .267 .088 .432 .187 .165 .095 .348 .293 .359 .374 .479 .839 .03 .121 .037 .263 .007 .143 .022 .759l.015 .853 .044 .106q.135 .286 .45 .337 .315 .051 .542-.158 .088-.091 .15-.194l.044-.12 .015-.693q0-.688-.029-1.025-.03-.337-.136-.637-.15-.451-.458-.868-.307-.421-.696-.707-.333-.242-.747-.384-.41-.143-.589-.096z"
                  fill="#6b6b78"
                />
              </svg>
              <div
                data-pencil-name="Label"
                class="text-[12.5px]/[normal] box-border [flex:1_1_0] text-[#9A9AA6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left"
              >
                Clientes
              </div>
            </div>
            <div
              data-pencil-name="Solicitações"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-[10px] p-[9px_10px] justify-start items-center rounded-[9px]"
            >
              <svg
                data-pencil-name="Icon"
                viewBox="0 0 15 15"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="inbox"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[15px] shrink-0 h-[15px] overflow-visible"
              >
                <path
                  d="M4.259 1.89q-.373 .058-.729 .278-.351 .216-.545 .516-.107 .15-1.216 2.388-1.11 2.234-1.132 2.318-.022 .081-.007 2.106v1.71q.015 .344 .029 .432 .136 .571 .546 .963 .414 .389 .985 .495 .179 .029 5.31 .029 5.131 0 5.31-.029 .571-.106 .982-.495 .413-.392 .549-.963 .015-.088 .029-.432v-1.71q.015-2.025-.007-2.106-.022-.084-1.132-2.318-1.109-2.238-1.201-2.373-.209-.315-.571-.538-.359-.227-.733-.271-.15-.015-3.241-.015-3.09 0-3.226 .015zM10.693 3.164q.107 .048 .198 .136 .073 .062 .209 .325 .135 .26 .765 1.491 .868 1.739 .868 1.754 0 .015-1.424 .015h-1.245q-.209 0-.301 .04-.088 .037-.172 .114-.08 .073-.622 .897l-.553 .824h-1.831l-.553-.824q-.542-.824-.627-.897-.08-.077-.172-.114-.088-.04-.296-.04h-1.246q-1.428 0-1.428-.015 0-.015 .872-1.754 .63-1.231 .765-1.491 .136-.263 .209-.325 .091-.088 .172-.118 .084-.033 .505-.047h2.714 2.714q.406 0 .479 .029zM5.219 8.939q.542 .824 .622 .901 .084 .073 .172 .114 .092 .036 .286 .036h1.201 1.201q.194 0 .282-.036 .092-.041 .172-.114 .085-.077 .627-.901l.553-.824h2.79l-.015 3.3-.044 .106q-.12 .223-.347 .315l-.103 .029h-10.232l-.102-.029q-.228-.092-.348-.315l-.044-.106-.015-3.3h2.791z"
                  fill="#6b6b78"
                />
              </svg>
              <div
                data-pencil-name="Label"
                class="text-[12.5px]/[normal] box-border [flex:1_1_0] text-[#9A9AA6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left"
              >
                Solicitações
              </div>
              <div
                data-pencil-name="Badge"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_6px] justify-center items-center bg-[#4C1D95] rounded-[999px]"
              >
                <div
                  data-pencil-name="Badge Text"
                  class="text-[9px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  5
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Financeiro"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-[10px] p-[9px_10px] justify-start items-center rounded-[9px]"
            >
              <svg
                data-pencil-name="Icon"
                viewBox="0 0 15 15"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="credit-card"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[15px] shrink-0 h-[15px] overflow-visible"
              >
                <path
                  d="M2.311 2.52q-.315 .029-.63 .179-.315 .15-.542 .406-.33 .345-.465 .854l-.044 .183v6.749l.044 .18q.077 .271 .194 .472 .121 .201 .315 .399 .198 .194 .399 .315 .201 .117 .472 .194l.18 .044h10.532l.18-.044q.271-.077 .472-.194 .201-.121 .396-.315 .197-.198 .314-.399 .121-.201 .198-.472l.044-.18v-6.782l-.044-.18q-.135-.494-.465-.824-.48-.523-1.216-.6-.179-.015-5.16-.015-4.98 0-5.174 .03zM12.752 3.809q.208 .106 .314 .315l.044 .106 .015 1.395h-11.25l.015-1.395 .044-.106q.12-.268 .406-.345 .092-.029 5.204-.029l5.101 .015zM13.125 8.818l-.015 1.952-.029 .092q-.135 .282-.406 .359-.088 .029-5.175 .029-5.087 0-5.175-.029-.271-.077-.406-.359l-.029-.092-.015-3.885h11.25z"
                  fill="#6b6b78"
                />
              </svg>
              <div
                data-pencil-name="Label"
                class="text-[12.5px]/[normal] box-border [flex:1_1_0] text-[#9A9AA6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left"
              >
                Financeiro
              </div>
            </div>
          </div>
        </div>
        <div
          data-pencil-name="Sidebar Bottom"
          class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] justify-start items-start"
        >
          <div
            data-pencil-name="Ver como cliente"
            class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[9px_12px] justify-center items-center bg-[#15151B] [outline:1px_solid_#26262E] [outline-offset:-0.5px] rounded-[10px]"
          >
            <div
              data-pencil-name="Label"
              class="text-[11.5px]/[normal] box-border text-[#C9C9D4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
            >
              Ver como cliente
            </div>
          </div>
          <div
            data-pencil-name="User"
            class="box-border w-full h-fit shrink-0 flex flex-row gap-[9px] p-[7px_8px] justify-start items-center bg-[#15151B] rounded-[10px]"
          >
            <div
              data-pencil-name="Avatar"
              class="box-border w-[28px] shrink-0 h-[28px] flex flex-col gap-0 justify-center items-center bg-[#6D28D9] rounded-[14px]"
            >
              <div
                data-pencil-name="Initials"
                class="text-[9.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                RL
              </div>
            </div>
            <div
              data-pencil-name="User Text"
              class="box-border [flex:1_1_0] h-fit flex flex-col gap-[1px] justify-start items-start"
            >
              <div
                data-pencil-name="User Name"
                class="text-[11.5px]/[normal] box-border text-[#F2F2F6] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left [white-space:nowrap]"
              >
                Rafael Lima
              </div>
              <div
                data-pencil-name="User Role"
                class="text-[9px]/[normal] box-border text-[#6B6B78] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
              >
                Gerente de projetos
              </div>
            </div>
            <svg
              data-pencil-name="Switch Icon"
              viewBox="0 0 13 13"
              preserveAspectRatio="xMidYMid meet"
              data-icon-name="chevrons-up-down"
              data-icon-set="lucide"
              xmlns="http://www.w3.org/2000/svg"
              class="box-border w-[13px] shrink-0 h-[13px] overflow-visible"
            >
              <path
                d="M6.357 1.65q-.079 .013-.136 .054-.057 .038-1.476 1.454l-1.13 1.146q-.26 .26-.314 .362-.051 .066-.038 .171v.051q0 .13 .038 .222 .092 .181 .292 .26 .203 .076 .397 .013 .066-.026 .253-.206 .191-.185 1.048-1.042l1.209-1.196 1.209 1.196q.857 .857 1.044 1.042 .191 .18 .258 .206 .193 .063 .393-.013 .203-.079 .295-.26 .038-.092 .038-.222v-.051q.013-.105-.038-.171-.054-.102-.314-.362l-1.13-1.146q-1.431-1.428-1.517-1.473-.082-.047-.194-.054-.107-.006-.187 .019zM3.602 7.617q-.092 .041-.177 .121-.083 .076-.118 .149-.032 .07-.038 .108-.006 .038-.006 .13v.038q-.013 .105 .038 .184 .066 .102 .339 .375 .181 .196 .899 .911l1.39 1.377q.26 .248 .362 .314 .066 .051 .171 .038h.076q.105 .013 .172-.038 .101-.066 .361-.314l1.39-1.377q.718-.715 .899-.911 .273-.273 .339-.375 .051-.079 .038-.184v-.038q0-.092-.006-.13-.006-.038-.032-.105-.041-.089-.127-.159-.082-.073-.174-.104-.089-.035-.213-.035-.124 0-.209 .041-.083 .038-1.279 1.232l-1.197 1.196-1.197-1.196q-1.196-1.194-1.282-1.232-.082-.041-.212-.041-.131 0-.207 .025z"
                fill="#5f5f68"
              />
            </svg>
          </div>
        </div>
      </div>
      <div
        data-pencil-name="Main"
        class="box-border [flex:1_1_0] h-full flex flex-col gap-[18px] p-[26px_30px] justify-start items-start"
      >
        <div
          data-pencil-name="Header"
          class="box-border w-full h-fit shrink-0 flex flex-row gap-[16px] justify-between items-start"
        >
          <div
            data-pencil-name="Header Text"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-[7px] justify-start items-start"
          >
            <div
              data-pencil-name="Page Title"
              class="text-[38px]/[normal] box-border font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-extrabold tracking-[-1.2px] text-left [white-space:nowrap]"
              style="-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; background-image: linear-gradient(0deg, #CBAAFF 0%, #9B6BF8 60%, #7C3AED 100%); background-repeat: no-repeat; background-size: 100% 100%; color: transparent"
            >
              Projetos
            </div>
            <div
              data-pencil-name="Page Subtitle"
              class="text-[12.5px]/[normal] box-border text-[#7C7C88] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
            >
              Arraste os cards entre as colunas para mudar a etapa.
            </div>
          </div>
          <div
            data-pencil-name="Novo projeto"
            class="box-border w-fit shrink-0 h-fit flex flex-row gap-[7px] p-[10px_16px] justify-start items-center bg-[#7C3AED] rounded-[9px]"
          >
            <svg
              data-pencil-name="Plus"
              viewBox="0 0 14 14"
              preserveAspectRatio="xMidYMid meet"
              data-icon-name="plus"
              data-icon-set="lucide"
              xmlns="http://www.w3.org/2000/svg"
              class="box-border w-[14px] shrink-0 h-[14px] overflow-visible"
            >
              <path
                d="M6.901 2.352q-.096 .013-.174 .051-.076 .034-.154 .126-.075 .089-.113 .168-.034 .075-.034 .328v3.401h-3.668l-.085 .041q-.222 .113-.301 .338-.075 .222 .007 .434 .058 .096 .14 .181 .086 .082 .168 .12 .085 .034 .338 .034h3.401v3.401q0 .253 .034 .338 .038 .083 .12 .168 .085 .082 .188 .133 .106 .048 .232 .048 .126 0 .229-.048 .106-.051 .188-.133 .085-.085 .12-.168 .037-.085 .037-.338v-3.401h3.401q.253 0 .335-.034 .086-.038 .168-.12 .085-.085 .133-.188 .051-.106 .051-.232 0-.126-.041-.239-.099-.195-.294-.294l-.085-.041h-3.668v-3.387q0-.267-.027-.322-.072-.198-.253-.301-.181-.105-.393-.064z"
                fill="#ffffff"
              />
            </svg>
            <div
              data-pencil-name="Label"
              class="text-[12px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left [white-space:nowrap]"
            >
              Novo projeto
            </div>
          </div>
        </div>
        <div
          data-pencil-name="Filters"
          class="box-border w-full h-fit shrink-0 flex flex-row gap-[12px] justify-between items-center"
        >
          <div
            data-pencil-name="Filters Left"
            class="box-border [flex:1_1_0] h-fit flex flex-row gap-[8px] justify-start items-center"
          >
            <div
              data-pencil-name="Search"
              class="box-border w-[300px] shrink-0 h-[36px] flex flex-row gap-[8px] p-[0px_12px] justify-start items-center bg-[#121217] [outline:1px_solid_#22222A] [outline-offset:-0.5px] rounded-[10px]"
            >
              <svg
                data-pencil-name="Search Icon"
                viewBox="0 0 13 13"
                preserveAspectRatio="xMidYMid meet"
                data-icon-name="search"
                data-icon-set="lucide"
                xmlns="http://www.w3.org/2000/svg"
                class="box-border w-[13px] shrink-0 h-[13px] overflow-visible"
              >
                <path
                  d="M5.576 1.092q-.038 .012-.219 .025-.533 .067-1.079 .27-.546 .2-1.015 .511-.365 .247-.695 .568-.33 .317-.578 .654-.6 .857-.806 1.885-.054 .26-.073 .429-.019 .168-.019 .533 0 .403 .025 .631 .026 .226 .118 .553 .181 .701 .558 1.333 .378 .628 .898 1.098 .378 .336 .759 .558 .384 .223 .854 .403 .987 .365 2.06 .273 1.072-.092 1.996-.612 .117-.064 .311-.194 .194-.13 .273-.197l.051-.05 1.028 1.028q1.041 1.025 1.117 1.073 .08 .044 .222 .044 .143 0 .219-.032 .08-.034 .169-.123 .092-.092 .123-.169 .035-.079 .035-.222 0-.142-.047-.219-.045-.079-1.07-1.12l-1.028-1.028 .051-.064q.053-.051 .184-.235 .764-1.142 .828-2.513 .067-1.371-.594-2.568-.495-.898-1.32-1.527-.825-.631-1.815-.866-.273-.064-.502-.089-.225-.029-.562-.041-.403 0-.457 0zM6.265 2.184q.352 .012 .736 .13 .385 .117 .734 .298 .688 .365 1.196 1.003 .508 .635 .702 1.39 .066 .26 .085 .464 .019 .199 .019 .472 0 .651-.181 1.21-.365 1.079-1.244 1.774-.876 .695-2.006 .812-.184 .013-.457 .007-.273-.007-.453-.032-.496-.079-.965-.286-.467-.209-.87-.52-.13-.118-.327-.318-.193-.203-.308-.346-.533-.714-.688-1.574-.08-.403-.061-.844 .019-.441 .111-.832 .273-1.066 1.105-1.818 .831-.756 1.91-.952 .169-.026 .391-.038 .222-.013 .324-.013z"
                  fill="#5f5f68"
                />
              </svg>
              <div
                data-pencil-name="Placeholder"
                class="text-[11.5px]/[normal] box-border text-[#5F5F68] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
              >
                Buscar projeto ou cliente
              </div>
            </div>
            <div
              data-pencil-name="Filter Todos"
              class="box-border w-fit shrink-0 h-fit flex flex-row gap-0 p-[9px_14px] justify-center items-center bg-[#7C3AED] rounded-[999px]"
            >
              <div
                data-pencil-name="Label"
                class="text-[11.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left [white-space:nowrap]"
              >
                Todos
              </div>
            </div>
            <div
              data-pencil-name="Filter Meus projetos"
              class="box-border w-fit shrink-0 h-fit flex flex-row gap-0 p-[9px_14px] justify-center items-center bg-[#121217] [outline:1px_solid_#22222A] [outline-offset:-0.5px] rounded-[999px]"
            >
              <div
                data-pencil-name="Label"
                class="text-[11.5px]/[normal] box-border text-[#A3A3AE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
              >
                Meus projetos
              </div>
            </div>
            <div
              data-pencil-name="Filter Com pendência"
              class="box-border w-fit shrink-0 h-fit flex flex-row gap-0 p-[9px_14px] justify-center items-center bg-[#121217] [outline:1px_solid_#22222A] [outline-offset:-0.5px] rounded-[999px]"
            >
              <div
                data-pencil-name="Label"
                class="text-[11.5px]/[normal] box-border text-[#A3A3AE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
              >
                Com pendência
              </div>
            </div>
            <div
              data-pencil-name="Filter Atrasados"
              class="box-border w-fit shrink-0 h-fit flex flex-row gap-0 p-[9px_14px] justify-center items-center bg-[#121217] [outline:1px_solid_#22222A] [outline-offset:-0.5px] rounded-[999px]"
            >
              <div
                data-pencil-name="Label"
                class="text-[11.5px]/[normal] box-border text-[#A3A3AE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
              >
                Atrasados
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Responsáveis"
            class="box-border w-fit shrink-0 h-fit flex flex-row gap-[24px] p-[9px_14px] justify-between items-center bg-[#121217] [outline:1px_solid_#22222A] [outline-offset:-0.5px] rounded-[10px]"
          >
            <div
              data-pencil-name="Label"
              class="text-[11.5px]/[normal] box-border text-[#A3A3AE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
            >
              Todos os responsáveis
            </div>
            <svg
              data-pencil-name="Chevron"
              viewBox="0 0 13 13"
              preserveAspectRatio="xMidYMid meet"
              data-icon-name="chevron-down"
              data-icon-set="lucide"
              xmlns="http://www.w3.org/2000/svg"
              class="box-border w-[13px] shrink-0 h-[13px] overflow-visible"
            >
              <path
                d="M3.107 4.354q-.235 .08-.352 .286-.038 .079-.038 .235 0 .156 .044 .241 .048 .083 1.73 1.768 1.685 1.682 1.768 1.73 .086 .044 .241 .044 .156 0 .238-.044 .086-.048 1.768-1.73 1.685-1.685 1.73-1.768 .047-.085 .047-.241 0-.156-.038-.235-.092-.155-.26-.247-.054-.026-.092-.039-.038-.012-.143-.012-.105 0-.143 .012-.038 .013-.105 .039-.092 .054-1.545 1.51l-1.457 1.454-2.625-2.612q-.289-.273-.39-.352-.079-.051-.184-.051h-.026q-.13 0-.168 .012z"
                fill="#5f5f68"
              />
            </svg>
          </div>
        </div>
        <div
          data-pencil-name="Kanban"
          class="box-border w-full h-fit shrink-0 flex flex-row gap-[12px] justify-start items-start"
        >
          <div
            data-pencil-name="Coluna Briefing"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-0 justify-start items-start bg-[#0E0E12] [outline:1px_solid_#1D1D24] [outline-offset:-0.5px] rounded-[14px] overflow-hidden"
          >
            <div
              data-pencil-name="Header"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[13px] justify-between items-center bg-[#15151B]"
            >
              <div
                data-pencil-name="Title"
                class="text-[12.5px]/[normal] box-border text-[#E8E8EE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                Briefing
              </div>
              <div
                data-pencil-name="Count"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_7px] justify-center items-center bg-[#232329] rounded-[999px]"
              >
                <div
                  data-pencil-name="Count Text"
                  class="text-[10px]/[normal] box-border text-[#A0A0AA] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  3
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Cards"
              class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] p-[10px] justify-start items-start"
            >
              <div
                data-pencil-name="Landing Aurora Pilates"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Studio Aurora Pilates
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Landing Aurora Pilates
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#2F260F] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#E5C465] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    Fotos pendentes
                  </div>
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    15%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 05 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[27px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#5B21B6] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      RL
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Rafael Lima
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Catálogo online"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Móveis Pereira
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Catálogo online
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    8%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 28 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[14px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#5B21B6] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      RL
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Rafael Lima
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Site institucional"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Escola Pequeno Mundo
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Site institucional
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    5%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 10 dez
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[9px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#4C1D95] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      DN
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Diego Nunes
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Coluna Design"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-0 justify-start items-start bg-[#0E0E12] [outline:1px_solid_#1D1D24] [outline-offset:-0.5px] rounded-[14px] overflow-hidden"
          >
            <div
              data-pencil-name="Header"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[13px] justify-between items-center bg-[#15151B]"
            >
              <div
                data-pencil-name="Title"
                class="text-[12.5px]/[normal] box-border text-[#E8E8EE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                Design
              </div>
              <div
                data-pencil-name="Count"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_7px] justify-center items-center bg-[#232329] rounded-[999px]"
              >
                <div
                  data-pencil-name="Count Text"
                  class="text-[10px]/[normal] box-border text-[#A0A0AA] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  3
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Cards"
              class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] p-[10px] justify-start items-start"
            >
              <div
                data-pencil-name="Site Clínica Vida Plena"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Clínica Vida Plena
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Site Clínica Vida Plena
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#33131B] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#F0777C] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    Vence em 2 dias
                  </div>
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    35%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 21 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[63px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#4C1D95] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      AC
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Ana Costa
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Promoção de Natal"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Padaria Doce Trigo
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Promoção de Natal
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    22%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 20 dez
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[40px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#4C1D95] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      AC
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Ana Costa
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Identidade para o cardápio digital"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Café Girassol
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Identidade para o cardápio digital
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    40%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 14 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[72px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#4C1D95] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      AC
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Ana Costa
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Coluna Desenvolvimento"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-0 justify-start items-start bg-[#0E0E12] [outline:1px_solid_#1D1D24] [outline-offset:-0.5px] rounded-[14px] overflow-hidden"
          >
            <div
              data-pencil-name="Header"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[13px] justify-between items-center bg-[#15151B]"
            >
              <div
                data-pencil-name="Title"
                class="text-[12.5px]/[normal] box-border text-[#E8E8EE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                Desenvolvimento
              </div>
              <div
                data-pencil-name="Count"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_7px] justify-center items-center bg-[#232329] rounded-[999px]"
              >
                <div
                  data-pencil-name="Count Text"
                  class="text-[10px]/[normal] box-border text-[#A0A0AA] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  5
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Cards"
              class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] p-[10px] justify-start items-start"
            >
              <div
                data-pencil-name="Loja online Doce Trigo"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Padaria Doce Trigo
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Loja online Doce Trigo
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    62%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 14 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[112px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#6D28D9] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      LA
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Lucas Almeida
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Loja Café Girassol"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Café Girassol
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Loja Café Girassol
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#33190D] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#F0944E] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    Fatura em atraso
                  </div>
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    48%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 12 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[86px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#6D28D9] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      LA
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Lucas Almeida
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Agendamento de aulas"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Studio Aurora Pilates
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Agendamento de aulas
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    70%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 02 nov
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[126px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#0F766E] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      BT
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Bruna Teixeira
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Coluna Revisão"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-0 justify-start items-start bg-[#0E0E12] [outline:1px_solid_#1D1D24] [outline-offset:-0.5px] rounded-[14px] overflow-hidden"
          >
            <div
              data-pencil-name="Header"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[13px] justify-between items-center bg-[#15151B]"
            >
              <div
                data-pencil-name="Title"
                class="text-[12.5px]/[normal] box-border text-[#E8E8EE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                Revisão
              </div>
              <div
                data-pencil-name="Count"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_7px] justify-center items-center bg-[#232329] rounded-[999px]"
              >
                <div
                  data-pencil-name="Count Text"
                  class="text-[10px]/[normal] box-border text-[#A0A0AA] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  3
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Cards"
              class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] p-[10px] justify-start items-start"
            >
              <div
                data-pencil-name="Site Doce Trigo"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Padaria Doce Trigo
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Site Doce Trigo
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#2F260F] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#E5C465] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    Aguardando cliente
                  </div>
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    88%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 30 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[158px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#4C1D95] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      AC
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Ana Costa
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Área de exames online"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Clínica Vida Plena
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Área de exames online
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    92%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 26 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[166px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#0F766E] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      BT
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Bruna Teixeira
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Site institucional"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Móveis Pereira
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Site institucional
                </div>
                <div
                  data-pencil-name="Progress Meta"
                  class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[3px_0px_0px_0px] justify-between items-center"
                >
                  <div
                    data-pencil-name="Pct"
                    class="text-[10px]/[normal] box-border text-[#C9C9D2] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    95%
                  </div>
                  <div
                    data-pencil-name="Prazo"
                    class="text-[9.5px]/[normal] box-border text-[#6B6B76] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Prazo 24 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[171px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#7C3AED] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#6D28D9] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      LA
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Lucas Almeida
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            data-pencil-name="Coluna Publicado"
            class="box-border [flex:1_1_0] h-fit flex flex-col gap-0 justify-start items-start bg-[#0E0E12] [outline:1px_solid_#1D1D24] [outline-offset:-0.5px] rounded-[14px] overflow-hidden"
          >
            <div
              data-pencil-name="Header"
              class="box-border w-full h-fit shrink-0 flex flex-row gap-0 p-[13px] justify-between items-center bg-[#15151B]"
            >
              <div
                data-pencil-name="Title"
                class="text-[12.5px]/[normal] box-border text-[#E8E8EE] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
              >
                Publicado
              </div>
              <div
                data-pencil-name="Count"
                class="box-border w-fit shrink-0 h-fit flex flex-col gap-0 p-[2px_7px] justify-center items-center bg-[#232329] rounded-[999px]"
              >
                <div
                  data-pencil-name="Count Text"
                  class="text-[10px]/[normal] box-border text-[#A0A0AA] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                >
                  2
                </div>
              </div>
            </div>
            <div
              data-pencil-name="Cards"
              class="box-border w-full h-fit shrink-0 flex flex-col gap-[10px] p-[10px] justify-start items-start"
            >
              <div
                data-pencil-name="Site Mecânica Irmãos Souza"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Mecânica Irmãos Souza
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Site Mecânica Irmãos Souza
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#0D2A1C] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#54D68E] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    No ar desde 18 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[180px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#22C55E] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#0F766E] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      BT
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Bruna Teixeira
                  </div>
                </div>
              </div>
              <div
                data-pencil-name="Página de matrículas"
                class="box-border w-full h-fit shrink-0 flex flex-col gap-[7px] p-[12px] justify-start items-start bg-[#15151A] [outline:1px_solid_#23232B] [outline-offset:-0.5px] rounded-[12px]"
              >
                <div
                  data-pencil-name="Client"
                  class="text-[9.5px]/[12px] box-border w-full text-[#75757F] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-semibold text-left"
                >
                  Escola Pequeno Mundo
                </div>
                <div
                  data-pencil-name="Title"
                  class="text-[12.5px]/[16px] box-border w-full text-[#EDEDF3] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left"
                >
                  Página de matrículas
                </div>
                <div
                  data-pencil-name="Tag"
                  class="box-border w-fit h-fit shrink-0 flex flex-col gap-0 p-[3px_8px] justify-center items-center bg-[#0D2A1C] rounded-[999px]"
                >
                  <div
                    data-pencil-name="Tag Text"
                    class="text-[9px]/[normal] box-border text-[#54D68E] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                  >
                    No ar desde 02 out
                  </div>
                </div>
                <div
                  data-pencil-name="Track"
                  class="box-border w-full h-[3px] shrink-0 flex flex-row gap-0 justify-start items-start bg-[#23232B] rounded-[2px]"
                >
                  <div
                    data-pencil-name="Fill"
                    class="box-border w-[180px] shrink-0 h-[3px] flex flex-row gap-0 justify-start items-start bg-[#22C55E] rounded-[2px]"
                  ></div>
                </div>
                <div
                  data-pencil-name="Assignee"
                  class="box-border w-fit h-fit shrink-0 flex flex-row gap-[6px] p-[3px_0px_0px_0px] justify-start items-center"
                >
                  <div
                    data-pencil-name="Avatar"
                    class="box-border w-[18px] shrink-0 h-[18px] flex flex-col gap-0 justify-center items-center bg-[#6D28D9] rounded-[9px]"
                  >
                    <div
                      data-pencil-name="Initials"
                      class="text-[7.5px]/[normal] box-border text-[#FFFFFF] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-bold text-left [white-space:nowrap]"
                    >
                      LA
                    </div>
                  </div>
                  <div
                    data-pencil-name="Name"
                    class="text-[9.5px]/[normal] box-border text-[#9A9AA4] font-['Plus_Jakarta_Sans',system-ui,sans-serif] font-medium text-left [white-space:nowrap]"
                  >
                    Lucas Almeida
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
