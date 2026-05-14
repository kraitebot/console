#!/usr/bin/env bash
# Extract HugeIcons SVGs from Boltify React sources into Blade partials.
# Each icon becomes resources/views/icons/<Name>.blade.php containing one <svg>.

set -euo pipefail

SRC_DIR="/Users/falcaob/Herd/boltify.test/src/components/icon/huge"
DST_DIR="/Users/falcaob/Herd/console.kraite.test/resources/views/icons"

ICONS=(
    # Sidebar tabs
    Home09 GridView BookBookmark02 Star
    # Aside head
    SidebarLeft01 SidebarLeft SidebarRight
    # Apps menu (level 1)
    Store04 UserMultiple PackageOpen DashboardSquare03 Invoice03 Mail01 Message02
    # Apps menu (level 2)
    ProductLoading DeliveryView01
    UserList EditUser02 UserAccount UserCircle UserGroup
    PackageSearch Edit02 PencilEdit02
    DashboardSquareSetting DashboardSquare01 DashboardBrowsing
    ListView LeftToRightListBullet LeftToRightListTriangle
    Invoice02 Invoice04
    MailOpen01 MailEdit02
    Comment01 Comment02
    # Pages examples
    Login03 AddTeam HelpSquare
    # UI controls
    ArrowDown01 Search01 PlusSignCircle Filter
    # Header right
    Notification03 LanguageSquare Sun03 Moon02 Computer
    # Misc used in /customer dashboard
    UserAdd02 MoreVerticalSquare01 Flag02 BookOpen02 Catalogue
    TextSquare TextSmallcaps AiBrowser ArtboardTool Award02 PerplexityAi
    Puzzle CustomField PaintBoard PieChart09 Clock03
    Loading02 Loading03 Archive01 GitMerge
)

mkdir -p "$DST_DIR"

extract() {
    local icon="$1"
    local src="${SRC_DIR}/${icon}.tsx"
    local dst="${DST_DIR}/${icon}.blade.php"

    if [[ ! -f "$src" ]]; then
        echo "MISS: ${icon}" >&2
        return
    fi

    grep -E '^const Svg' "$src" \
        | sed -E 's/^const Svg[A-Za-z0-9]+ = \(props: SVGProps<SVGSVGElement>\) => //' \
        | sed -E 's/;[[:space:]]*$//' \
        | sed -E 's/ \{\.\.\.props\}//' \
        | sed -E 's/className=/class=/g' \
        | sed -E 's/([a-zA-Z]+)=\{(-?[0-9.]+)\}/\1="\2"/g' \
        | sed -E 's/strokeWidth=/stroke-width=/g' \
        | sed -E 's/strokeLinecap=/stroke-linecap=/g' \
        | sed -E 's/strokeLinejoin=/stroke-linejoin=/g' \
        | sed -E 's/strokeMiterlimit=/stroke-miterlimit=/g' \
        | sed -E 's/strokeDasharray=/stroke-dasharray=/g' \
        | sed -E 's/fillRule=/fill-rule=/g' \
        | sed -E 's/clipRule=/clip-rule=/g' \
        | sed -E 's/xlinkHref=/xlink:href=/g' \
        > "$dst"
}

for icon in "${ICONS[@]}"; do
    extract "$icon"
done

echo "Extracted: $(ls "$DST_DIR" | wc -l) icons"
