del messages.po
del messages.pot
type nul > messages.po
find ./app/views -type f -exec xgettext -j {} ;
ren messages.po messages.pot
